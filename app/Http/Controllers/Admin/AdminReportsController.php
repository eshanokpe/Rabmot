<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Order;
use App\Models\PaymentModel;
use App\Models\ProcessHistory;
use App\Models\WalletPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportsController extends Controller
{
    private const REPORTS = ['revenue', 'orders', 'agent-performance', 'referrals'];
    private const FORMATS = ['csv', 'pdf'];

    public const ORDER_STATUS_LABELS = [
        0 => 'Pending',
        1 => 'Processing',
        2 => 'Ready for Delivery',
        3 => 'Delivery in Progress',
        4 => 'Delivered',
    ];

    public function revenue(Request $request)
    {
        $data = $this->buildRevenueData($request);
        return view('admin.pages.reports.revenue', $data);
    }

    public function orders(Request $request)
    {
        $data = $this->buildOrdersData($request);
        return view('admin.pages.reports.orders', $data);
    }

    public function agentPerformance(Request $request)
    {
        $data = $this->buildAgentPerformanceData($request);
        return view('admin.pages.reports.agent-performance', $data);
    }

    public function referrals(Request $request)
    {
        $data = $this->buildReferralsData($request);
        return view('admin.pages.reports.referrals', $data);
    }

    public function export(Request $request, string $report, string $format)
    {
        if (!in_array($report, self::REPORTS) || !in_array($format, self::FORMATS)) {
            abort(404);
        }

        $method = 'build' . str_replace(' ', '', ucwords(str_replace('-', ' ', $report))) . 'Data';
        $data = $this->{$method}($request);
        $filename = $report . '-' . now()->format('Y-m-d_His');

        if ($format === 'pdf') {
            return Pdf::loadView("admin.pages.reports.pdf.{$report}", $data)->download("{$filename}.pdf");
        }

        return $this->streamCsv($report, $data, $filename);
    }

    private function dateRange(Request $request): array
    {
        $from = $request->filled('date_from')
            ? Carbon::parse($request->date_from)->startOfDay()
            : Carbon::now()->startOfMonth();
        $to = $request->filled('date_to')
            ? Carbon::parse($request->date_to)->endOfDay()
            : Carbon::now()->endOfDay();

        return [$from, $to];
    }

    private function buildRevenueData(Request $request): array
    {
        [$from, $to] = $this->dateRange($request);

        $query = PaymentModel::where('status', 'Successful')->whereBetween('created_at', [$from, $to]);

        $totalRevenue = (clone $query)->sum('amount');
        $transactionCount = (clone $query)->count();
        $averageTransaction = $transactionCount > 0 ? $totalRevenue / $transactionCount : 0;

        $dailySeries = (clone $query)
            ->select(DB::raw('DATE(created_at) as day'), DB::raw('SUM(amount) as total'))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $payments = (clone $query)->orderByDesc('created_at')->limit(500)->get();

        return [
            'from' => $from,
            'to' => $to,
            'totalRevenue' => $totalRevenue,
            'transactionCount' => $transactionCount,
            'averageTransaction' => $averageTransaction,
            'dailySeries' => $dailySeries,
            'payments' => $payments,
        ];
    }

    private function buildOrdersData(Request $request): array
    {
        [$from, $to] = $this->dateRange($request);

        $query = ProcessHistory::whereBetween('created_at', [$from, $to]);
        if ($request->filled('process_type')) {
            $query->where('process_type', $request->process_type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $totalOrders = (clone $query)->count();

        $byStatus = (clone $query)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $byType = (clone $query)
            ->select('process_type', DB::raw('count(*) as total'))
            ->groupBy('process_type')
            ->orderByDesc('total')
            ->get();

        $processTypes = ProcessHistory::select('process_type')->distinct()->pluck('process_type');

        $orders = (clone $query)->orderByDesc('created_at')->limit(500)->get();

        return [
            'from' => $from,
            'to' => $to,
            'totalOrders' => $totalOrders,
            'byStatus' => $byStatus,
            'byType' => $byType,
            'processTypes' => $processTypes,
            'orders' => $orders,
            'selectedType' => $request->process_type,
            'selectedStatus' => $request->status,
        ];
    }

    private function agentAggregates(Request $request): array
    {
        [$from, $to] = $this->dateRange($request);

        $orderCounts = Order::where('userType', 'agent')
            ->whereBetween('created_at', [$from, $to])
            ->select('user_id', DB::raw('count(*) as c'))
            ->groupBy('user_id')
            ->pluck('c', 'user_id');

        $earnings = WalletPayment::where('userType', 'agent')
            ->whereBetween('created_at', [$from, $to])
            ->select('user_id', DB::raw('sum(amount) as s'))
            ->groupBy('user_id')
            ->pluck('s', 'user_id');

        $referralCommission = WalletPayment::where('userType', 'agent')
            ->where('type', 'referral_commission')
            ->whereBetween('created_at', [$from, $to])
            ->select('user_id', DB::raw('sum(amount) as s'))
            ->groupBy('user_id')
            ->pluck('s', 'user_id');

        $referralCounts = Agent::whereNotNull('referred_by')
            ->select('referred_by', DB::raw('count(*) as c'))
            ->groupBy('referred_by')
            ->pluck('c', 'referred_by');

        return compact('from', 'to', 'orderCounts', 'earnings', 'referralCommission', 'referralCounts');
    }

    private function buildAgentPerformanceData(Request $request): array
    {
        ['from' => $from, 'to' => $to, 'orderCounts' => $orderCounts, 'earnings' => $earnings,
            'referralCommission' => $referralCommission, 'referralCounts' => $referralCounts] = $this->agentAggregates($request);

        $agents = Agent::all()->map(function ($agent) use ($orderCounts, $earnings, $referralCommission, $referralCounts) {
            return (object) [
                'agent' => $agent,
                'orders' => $orderCounts[$agent->id] ?? 0,
                'revenue' => $earnings[$agent->id] ?? 0,
                'referrals' => $referralCounts[$agent->id] ?? 0,
                'referralCommission' => $referralCommission[$agent->id] ?? 0,
            ];
        });

        $sortBy = in_array($request->sort_by, ['revenue', 'orders', 'referrals']) ? $request->sort_by : 'revenue';
        $agents = $agents->sortByDesc($sortBy)->values();

        $page = max(1, (int) $request->get('page', 1));
        $perPage = 25;
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $agents->forPage($page, $perPage),
            $agents->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return [
            'from' => $from,
            'to' => $to,
            'agents' => $paginated,
            'allAgents' => $agents,
            'sortBy' => $sortBy,
        ];
    }

    private function buildReferralsData(Request $request): array
    {
        ['from' => $from, 'to' => $to, 'referralCounts' => $referralCounts,
            'referralCommission' => $referralCommission] = $this->agentAggregates($request);

        $referrers = Agent::whereIn('id', $referralCounts->keys())
            ->get()
            ->map(function ($agent) use ($referralCounts, $referralCommission) {
                return (object) [
                    'agent' => $agent,
                    'referrals' => $referralCounts[$agent->id] ?? 0,
                    'referralCommission' => $referralCommission[$agent->id] ?? 0,
                ];
            })
            ->sortByDesc('referrals')
            ->values();

        $totalReferrals = $referralCounts->sum();
        $totalReferralCommission = $referralCommission->sum();

        return [
            'from' => $from,
            'to' => $to,
            'referrers' => $referrers,
            'totalReferrals' => $totalReferrals,
            'totalReferralCommission' => $totalReferralCommission,
        ];
    }

    private function streamCsv(string $report, array $data, string $filename)
    {
        $rows = $this->csvRows($report, $data);

        return response()->streamDownload(function () use ($rows) {
            $handle = fopen('php://output', 'w');
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, "{$filename}.csv", ['Content-Type' => 'text/csv']);
    }

    private function csvRows(string $report, array $data): array
    {
        switch ($report) {
            case 'revenue':
                $rows = [['Order No', 'Amount', 'Status', 'Date']];
                foreach ($data['payments'] as $p) {
                    $rows[] = [$p->orderNo, $p->amount, $p->status, $p->created_at];
                }
                return $rows;

            case 'orders':
                $rows = [['Process Number', 'Process Type', 'Status', 'Date']];
                foreach ($data['orders'] as $o) {
                    $rows[] = [$o->process_number, $o->process_type, self::ORDER_STATUS_LABELS[$o->status] ?? $o->status, $o->created_at];
                }
                return $rows;

            case 'agent-performance':
                $rows = [['Agent', 'Email', 'Orders', 'Revenue', 'Referrals', 'Referral Commission']];
                foreach ($data['allAgents'] as $row) {
                    $rows[] = [$row->agent->fullname, $row->agent->email, $row->orders, $row->revenue, $row->referrals, $row->referralCommission];
                }
                return $rows;

            case 'referrals':
                $rows = [['Agent', 'Email', 'Referrals', 'Referral Commission']];
                foreach ($data['referrers'] as $row) {
                    $rows[] = [$row->agent->fullname, $row->agent->email, $row->referrals, $row->referralCommission];
                }
                return $rows;
        }

        return [];
    }
}
