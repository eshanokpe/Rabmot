<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AgentApprovedMessage;
use App\Mail\AgentRejectedMessage;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminAgentApprovalController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');
        $items = Agent::where('approval_status', $status)->latest()->paginate(20);

        return view('admin.pages.agentApprovals.index', compact('items', 'status'));
    }

    public function show($id)
    {
        $item = Agent::find(decrypt($id));

        if (!$item) {
            abort(404);
        }

        return view('admin.pages.agentApprovals.show', compact('item'));
    }

    public function approve($id)
    {
        $item = Agent::find(decrypt($id));

        if (!$item) {
            return redirect()->back()->with('error', 'Agent not found.');
        }

        $item->approval_status = 'approved';
        $item->approved_by = Auth::guard('admin')->user()->id;
        $item->approved_at = now();
        $item->rejection_reason = null;
        $item->save();

        try {
            Mail::to($item->email)->send(new AgentApprovedMessage($item->email, $item->fullname, $item->username));
        } catch (\Exception $e) {
            // Approval still succeeds even if the notification email fails.
        }

        return redirect()->route('admin.agentApprovals.index')->with('success', 'Agent approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rejection_reason' => 'required|string|min:5|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = Agent::find(decrypt($id));

        if (!$item) {
            return redirect()->back()->with('error', 'Agent not found.');
        }

        $item->approval_status = 'rejected';
        $item->approved_by = Auth::guard('admin')->user()->id;
        $item->approved_at = now();
        $item->rejection_reason = $request->input('rejection_reason');
        $item->save();

        try {
            Mail::to($item->email)->send(new AgentRejectedMessage($item->email, $item->fullname, $item->username, $item->rejection_reason));
        } catch (\Exception $e) {
            // Rejection still succeeds even if the notification email fails.
        }

        return redirect()->route('admin.agentApprovals.index')->with('success', 'Agent application rejected.');
    }

    public function downloadMeansOfIdentification($id)
    {
        $item = Agent::findOrFail(decrypt($id));

        if (empty($item->means_of_identification)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }

        $fullPath = public_path('documents/agentApprovals/' . $item->means_of_identification);

        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'The requested document does not exist.');
        }

        return response()->download($fullPath);
    }

    public function downloadPassportPhotograph($id)
    {
        $item = Agent::findOrFail(decrypt($id));

        if (empty($item->passport_photograph)) {
            return redirect()->back()->with('error', 'No document uploaded for this record.');
        }

        $fullPath = public_path('documents/agentApprovals/' . $item->passport_photograph);

        if (!file_exists($fullPath)) {
            return redirect()->back()->with('error', 'The requested document does not exist.');
        }

        return response()->download($fullPath);
    }
}
