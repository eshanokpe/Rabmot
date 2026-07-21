<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WithdrawalPaidMessage;
use App\Mail\WithdrawalRejectedMessage;
use App\Models\Agent;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminAgentWithdrawalController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $query = Wallet::where('userType', 'agent');
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $items = $query->latest()->paginate(20)->withQueryString();

        return view('admin.pages.withdrawalQueue.index', compact('items', 'status'));
    }

    public function show($id)
    {
        $item = Wallet::where('userType', 'agent')->find(decrypt($id));

        if (!$item) {
            abort(404);
        }

        $agent = Agent::find($item->user_id);

        return view('admin.pages.withdrawalQueue.show', compact('item', 'agent'));
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'confirm_approval' => 'required|accepted',
        ]);

        $wallet = Wallet::where('userType', 'agent')->find(decrypt($id));
        if (!$wallet) {
            return redirect()->back()->with('error', 'Withdrawal request not found.');
        }

        if ($wallet->status !== 'pending') {
            return redirect()->back()->with('error', 'This request has already been reviewed.');
        }

        $wallet->status = 'approved';
        $wallet->reviewed_by = Auth::guard('admin')->user()->id;
        $wallet->reviewed_at = now();
        $wallet->save();

        return redirect()->back()->with('success', 'Withdrawal request approved.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|min:5|max:1000',
        ]);

        $wallet = Wallet::where('userType', 'agent')->find(decrypt($id));
        if (!$wallet) {
            return redirect()->back()->with('error', 'Withdrawal request not found.');
        }

        if ($wallet->status !== 'pending') {
            return redirect()->back()->with('error', 'This request has already been reviewed.');
        }

        $wallet->status = 'rejected';
        $wallet->rejection_reason = $request->input('rejection_reason');
        $wallet->reviewed_by = Auth::guard('admin')->user()->id;
        $wallet->reviewed_at = now();
        $wallet->save();

        try {
            $agent = Agent::find($wallet->user_id);
            if ($agent) {
                Mail::to($wallet->user_email)->send(new WithdrawalRejectedMessage(
                    $wallet->user_email, $agent->fullname, $wallet->amount, $wallet->rejection_reason
                ));
            }
        } catch (\Exception $e) {
            // Rejection still succeeds even if the notification email fails.
        }

        return redirect()->back()->with('success', 'Withdrawal request rejected.');
    }

    public function markPaid(Request $request, $id)
    {
        $request->validate([
            'transaction_reference' => 'required|string|max:255',
            'payment_proof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:9048',
            'confirm_paid' => 'required|accepted',
        ]);

        $walletId = decrypt($id);

        $result = DB::transaction(function () use ($request, $walletId) {
            $wallet = Wallet::where('userType', 'agent')->where('id', $walletId)->lockForUpdate()->first();

            if (!$wallet) {
                return ['error' => 'Withdrawal request not found.'];
            }

            if ($wallet->status !== 'approved') {
                return ['error' => 'This request cannot be marked as paid from its current status. It may have already been paid.'];
            }

            $proofFile = $request->file('payment_proof');
            $proofFilename = time() . '_' . $wallet->id . '_proof.' . $proofFile->getClientOriginalExtension();
            $proofFile->move(public_path('documents/withdrawalProofs'), $proofFilename);

            $wallet->status = 'paid';
            $wallet->transaction_reference = $request->input('transaction_reference');
            $wallet->payment_proof = $proofFilename;
            $wallet->paid_by = Auth::guard('admin')->user()->id;
            $wallet->paid_at = now();
            $wallet->save();

            return ['wallet' => $wallet];
        });

        if (isset($result['error'])) {
            return redirect()->back()->with('error', $result['error']);
        }

        $wallet = $result['wallet'];

        try {
            $agent = Agent::find($wallet->user_id);
            if ($agent) {
                Mail::to($wallet->user_email)->send(new WithdrawalPaidMessage(
                    $wallet->user_email, $agent->fullname, $wallet->amount, $wallet->transaction_reference
                ));
            }
        } catch (\Exception $e) {
            // Paid status still succeeds even if the notification email fails.
        }

        return redirect()->back()->with('success', 'Withdrawal marked as paid and agent notified.');
    }

    public function downloadProof($id)
    {
        $item = Wallet::where('userType', 'agent')->findOrFail(decrypt($id));

        if (empty($item->payment_proof)) {
            return redirect()->back()->with('error', 'No payment proof uploaded for this record.');
        }

        $fullPath = public_path('documents/withdrawalProofs/' . $item->payment_proof);

        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'The requested file does not exist.');
        }

        return response()->download($fullPath);
    }
}
