<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCommissionTier extends Model
{
    protected $table = 'agent_commission_tiers';

    protected $fillable = [
        'name',
        'min_referrals',
        'max_referrals',
        'rate',
        'sort_order',
        'updated_by',
    ];

    public function matches(int $referralCount): bool
    {
        if ($referralCount < $this->min_referrals) {
            return false;
        }

        if (!is_null($this->max_referrals) && $referralCount > $this->max_referrals) {
            return false;
        }

        return true;
    }
}
