<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DocumentExpiryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DocumentExpiryController extends Controller
{
    // "soon" = expiring within the alert window (the dashboard tile's link)
    private const STATUS_FILTERS = ['expired', 'week', 'soon', 'valid', 'none'];

    public function index(Request $request, DocumentExpiryService $service)
    {
        $filters = $request->validate([
            'status' => 'nullable|in:' . implode(',', self::STATUS_FILTERS),
            'document' => 'nullable|in:' . implode(',', array_keys(DocumentExpiryService::DOCUMENT_LABELS)),
            'source' => 'nullable|in:' . implode(',', array_keys(DocumentExpiryService::SOURCES)),
            'search' => 'nullable|string|max:100',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);

        $all = $service->allDocuments();

        $counts = [
            'expired' => $all->where('status', DocumentExpiryService::STATUS_EXPIRED)->count(),
            'week' => $all->where('status', DocumentExpiryService::STATUS_WEEK)->count(),
            'soon' => $all->whereIn('status', [DocumentExpiryService::STATUS_WEEK, DocumentExpiryService::STATUS_MONTH])->count(),
            'valid' => $all->where('status', DocumentExpiryService::STATUS_VALID)->count(),
            'none' => $all->where('status', DocumentExpiryService::STATUS_NONE)->count(),
        ];

        $documents = $this->applyFilters($all, $filters);
        $documents = $this->sortByUrgency($documents);

        $perPage = 25;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageItems = $service->attachLastReminders($documents->forPage($page, $perPage)->values())
            ->map(function ($document) use ($service) {
                $document['message'] = $document['expiry_date'] ? $service->buildMessage($document) : null;

                return $document;
            });

        $paginated = new LengthAwarePaginator($pageItems, $documents->count(), $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('admin.pages.documentExpiry.index', [
            'documents' => $paginated,
            'counts' => $counts,
            'filters' => $filters,
            'windowDays' => $service->alertWindowDays(),
            'documentLabels' => DocumentExpiryService::DOCUMENT_LABELS,
            'sources' => collect(DocumentExpiryService::SOURCES)->map(fn ($config) => $config['label']),
        ]);
    }

    // Email/SMS go out immediately; WhatsApp is logged, then opens the pre-filled wa.me chat
    public function sendReminder(Request $request, DocumentExpiryService $service)
    {
        $validated = $request->validate([
            'channel' => 'required|in:' . implode(',', DocumentExpiryService::CHANNELS),
            'source' => 'required|in:' . implode(',', array_keys(DocumentExpiryService::SOURCES)),
            'record' => 'required|string',
            'document_field' => 'required|in:' . implode(',', array_keys(DocumentExpiryService::DOCUMENT_LABELS)),
            'message' => 'nullable|string|max:1000',
        ]);

        try {
            $recordId = (int) decrypt($validated['record']);
        } catch (\Throwable $e) {
            abort(404);
        }

        $document = $service->findDocument($validated['source'], $recordId, $validated['document_field']);

        if (!$document) {
            abort(404);
        }

        if (!$service->needsReminder($document)) {
            return redirect()->back()->with('error', 'This document is not expired or expiring soon.');
        }

        $admin = Auth::guard('admin')->user();
        $channel = $validated['channel'];

        if ($channel === 'whatsapp') {
            if (!$document['phone']) {
                return redirect()->back()->with('error', 'No valid phone number on record.');
            }

            $message = trim($validated['message'] ?? '') ?: $service->buildMessage($document);
            $service->logWhatsapp($document, $admin, $message);

            return redirect()->away($service->whatsappUrl($document['phone'], $message));
        }

        $log = $channel === 'email'
            ? $service->sendEmail($document, $admin)
            : $service->sendSms($document, $admin, $validated['message'] ?? null);

        $channelLabel = $channel === 'email' ? 'Email' : 'SMS';

        return $log->status === 'sent'
            ? redirect()->back()->with('success', "{$channelLabel} reminder for {$document['label']} sent to {$log->recipient}.")
            : redirect()->back()->with('error', "{$channelLabel} reminder for {$document['label']} failed: {$log->error_message}");
    }

    private function applyFilters($documents, array $filters)
    {
        if (!empty($filters['status'])) {
            $statuses = $filters['status'] === 'soon'
                ? [DocumentExpiryService::STATUS_WEEK, DocumentExpiryService::STATUS_MONTH]
                : [$filters['status']];
            $documents = $documents->whereIn('status', $statuses);
        }

        if (!empty($filters['document'])) {
            $documents = $documents->where('field', $filters['document']);
        }

        if (!empty($filters['source'])) {
            $documents = $documents->where('source', $filters['source']);
        }

        if (!empty($filters['search'])) {
            $needle = Str::lower(trim($filters['search']));
            $digits = preg_replace('/\D+/', '', $needle);
            $documents = $documents->filter(function ($document) use ($needle, $digits) {
                return Str::contains(Str::lower((string) $document['plate']), $needle)
                    || Str::contains(Str::lower((string) $document['owner_name']), $needle)
                    || ($digits !== '' && Str::contains(preg_replace('/\D+/', '', (string) $document['raw_phone']), $digits));
            });
        }

        if (!empty($filters['from'])) {
            $from = Carbon::parse($filters['from'])->startOfDay();
            $documents = $documents->filter(fn ($document) => $document['expiry_date'] && $document['expiry_date']->gte($from));
        }

        if (!empty($filters['to'])) {
            $to = Carbon::parse($filters['to'])->endOfDay();
            $documents = $documents->filter(fn ($document) => $document['expiry_date'] && $document['expiry_date']->lte($to));
        }

        return $documents;
    }

    // Expiring soon first (soonest at top), then expired (most recent first),
    // then valid (soonest first), then documents with no date.
    private function sortByUrgency($documents)
    {
        $groupOrder = [
            DocumentExpiryService::STATUS_WEEK => 0,
            DocumentExpiryService::STATUS_MONTH => 0,
            DocumentExpiryService::STATUS_EXPIRED => 1,
            DocumentExpiryService::STATUS_VALID => 2,
            DocumentExpiryService::STATUS_NONE => 3,
        ];

        return $documents->sort(function ($a, $b) use ($groupOrder) {
            $group = $groupOrder[$a['status']] <=> $groupOrder[$b['status']];
            if ($group !== 0) {
                return $group;
            }

            if ($a['days_remaining'] === null || $b['days_remaining'] === null) {
                return strcmp((string) $a['plate'], (string) $b['plate']);
            }

            return $a['status'] === DocumentExpiryService::STATUS_EXPIRED
                ? $b['days_remaining'] <=> $a['days_remaining']
                : $a['days_remaining'] <=> $b['days_remaining'];
        })->values();
    }
}
