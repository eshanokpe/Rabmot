<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCommissionSetting extends Model
{
    protected $table = 'agent_commission_settings';

    protected $fillable = [
        'rate',
        'updated_by',
    ];
}
