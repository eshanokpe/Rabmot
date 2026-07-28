<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentCommissionAuditLog;
use App\Models\AgentCommissionSetting;
use App\Models\AgentCommissionTier;
use App\Services\AgentCommissionAuditLogger;
use App\Services\AgentReferralCommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminAgentCommissionController extends Controller
{
    public function index(Request $request)
    {
        $setting = AgentCommissionSetting::first();
        $tiers = AgentCommissionTier::orderBy('sort_order')->get();
        $overriddenAgents = Agent::whereNotNull('commission_override_rate')->orderBy('fullname')->get();
        $auditLogs = AgentCommissionAuditLog::with('admin')->latest()->paginate(20);

        return view('admin.pages.agents.commission', compact('setting', 'tiers', 'overriddenAgents', 'auditLogs'));
    }

    public function updateBaseRate(Request $request)
    {
        $validated = $request->validate([
            'rate' => 'required|numeric|min:0|max:100',
        ]);

        $admin = Auth::guard('admin')->user();
        $setting = AgentCommissionSetting::first();
        $old = $setting->rate;

        $setting->rate = $validated['rate'];
        $setting->updated_by = $admin->id;
        $setting->save();

        (new AgentCommissionAuditLogger())->log(
            $admin,
            'base_rate_updated',
            "Base commission rate changed from {$old}% to {$setting->rate}%",
            (string) $old,
            (string) $setting->rate
        );

        return redirect()->route('admin.commission.index')->with('success', 'Base commission rate updated successfully.');
    }

    public function previewCommission(Request $request)
    {
        $validated = $request->validate([
            'preview_agent_identifier' => 'required|string',
            'preview_amount' => 'required|numeric|min:0',
        ]);

        $agent = Agent::where('username', $validated['preview_agent_identifier'])
            ->orWhere('email', $validated['preview_agent_identifier'])
            ->first();

        if (!$agent) {
            return redirect()->route('admin.commission.index')->with('error', 'Agent not found.')->withInput();
        }

        $resolved = (new AgentReferralCommissionService())->resolveRateForAgent($agent);

        $previewResult = [
            'agent' => $agent,
            'amount' => $validated['preview_amount'],
            'rate' => $resolved['rate'],
            'source' => $resolved['source'],
            'tier' => $resolved['tier'],
            'commission' => $validated['preview_amount'] * ($resolved['rate'] / 100),
        ];

        return redirect()->route('admin.commission.index')->with('previewResult', $previewResult)->withInput();
    }

    public function storeTier(Request $request)
    {
        $validated = $this->validateTier($request);
        if ($validated instanceof \Illuminate\Http\RedirectResponse) {
            return $validated;
        }

        $admin = Auth::guard('admin')->user();
        $validated['updated_by'] = $admin->id;
        $tier = AgentCommissionTier::create($validated);

        (new AgentCommissionAuditLogger())->log(
            $admin,
            'tier_created',
            "Tier \"{$tier->name}\" created ({$tier->min_referrals}-" . ($tier->max_referrals ?? '∞') . " referrals at {$tier->rate}%)",
            null,
            (string) $tier->rate,
            null,
            $tier->id
        );

        return redirect()->route('admin.commission.index')->with('success', 'Tier created successfully.');
    }

    public function updateTier(Request $request, $id)
    {
        $tier = AgentCommissionTier::find($id);
        if (!$tier) {
            return redirect()->route('admin.commission.index')->with('error', 'Tier not found.');
        }

        $validated = $this->validateTier($request, $tier->id);
        if ($validated instanceof \Illuminate\Http\RedirectResponse) {
            return $validated;
        }

        $admin = Auth::guard('admin')->user();
        $old = "{$tier->min_referrals}-" . ($tier->max_referrals ?? '∞') . " @ {$tier->rate}%";

        $validated['updated_by'] = $admin->id;
        $tier->fill($validated);
        $tier->save();

        $new = "{$tier->min_referrals}-" . ($tier->max_referrals ?? '∞') . " @ {$tier->rate}%";

        (new AgentCommissionAuditLogger())->log(
            $admin,
            'tier_updated',
            "Tier \"{$tier->name}\" updated from [{$old}] to [{$new}]",
            $old,
            $new,
            null,
            $tier->id
        );

        return redirect()->route('admin.commission.index')->with('success', 'Tier updated successfully.');
    }

    public function destroyTier($id)
    {
        $tier = AgentCommissionTier::find($id);
        if (!$tier) {
            return redirect()->route('admin.commission.index')->with('error', 'Tier not found.');
        }

        $admin = Auth::guard('admin')->user();
        $description = "Tier \"{$tier->name}\" ({$tier->min_referrals}-" . ($tier->max_referrals ?? '∞') . " @ {$tier->rate}%) deleted";

        (new AgentCommissionAuditLogger())->log(
            $admin,
            'tier_deleted',
            $description,
            (string) $tier->rate,
            null,
            null,
            $tier->id
        );

        $tier->delete();

        return redirect()->route('admin.commission.index')->with('success', 'Tier deleted successfully.');
    }

    private function validateTier(Request $request, ?int $excludeId = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'min_referrals' => 'required|integer|min:0',
            'max_referrals' => 'nullable|integer|min:0|gte:min_referrals',
            'rate' => 'required|numeric|min:0|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.commission.index')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $overlap = $this->tierRangeOverlaps($validated['min_referrals'], $validated['max_referrals'] ?? null, $excludeId);
        if ($overlap) {
            return redirect()->route('admin.commission.index')
                ->withErrors(['min_referrals' => "This range overlaps with existing tier \"{$overlap->name}\"."])
                ->withInput();
        }

        return $validated;
    }

    private function tierRangeOverlaps(int $min, ?int $max, ?int $excludeId = null): ?AgentCommissionTier
    {
        $max = $max ?? PHP_INT_MAX;

        return AgentCommissionTier::when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->get()
            ->first(function ($tier) use ($min, $max) {
                $tierMax = $tier->max_referrals ?? PHP_INT_MAX;
                return $min <= $tierMax && $tier->min_referrals <= $max;
            });
    }
}
