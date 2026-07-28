<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\AgentCommissionSetting;
use App\Models\AgentCommissionTier;
use App\Models\WalletPayment;

class AgentReferralCommissionService
{
    public function getCommissionRate(): float
    {
        return (float) (AgentCommissionSetting::first()->rate ?? 0);
    }

    public function resolveRateForAgent(Agent $referrer): array
    {
        if (!is_null($referrer->commission_override_rate)) {
            return [
                'rate' => (float) $referrer->commission_override_rate,
                'source' => 'override',
                'tier' => null,
            ];
        }

        $referralCount = Agent::where('referred_by', $referrer->id)->count();
        $tier = AgentCommissionTier::orderBy('sort_order')->get()->first(fn ($t) => $t->matches($referralCount));

        if ($tier) {
            return [
                'rate' => (float) $tier->rate,
                'source' => 'tier',
                'tier' => $tier,
            ];
        }

        return [
            'rate' => $this->getCommissionRate(),
            'source' => 'base',
            'tier' => null,
        ];
    }

    public function resolveRateValueForAgent(Agent $referrer): float
    {
        return $this->resolveRateForAgent($referrer)['rate'];
    }

    public function creditForOrderItem(
        Agent $purchasingAgent,
        float $itemTotal,
        ?string $processId,
        ?string $processNumber,
        ?string $processType,
        ?float $commissionRate = null
    ): ?WalletPayment {
        if (empty($purchasingAgent->referred_by)) {
            return null;
        }

        $referrer = Agent::find($purchasingAgent->referred_by);
        if (!$referrer) {
            return null;
        }

        $rate = $commissionRate ?? $this->resolveRateValueForAgent($referrer);
        if ($rate <= 0) {
            return null;
        }

        return WalletPayment::create([
            'user_id' => $referrer->id,
            'user_email' => $referrer->email,
            'userType' => 'agent',
            'type' => 'referral_commission',
            'source_agent_id' => $purchasingAgent->id,
            'amount' => $itemTotal * ($rate / 100),
            'process_id' => $processId,
            'process_number' => $processNumber,
            'process_type' => $processType,
        ]);
    }
}
