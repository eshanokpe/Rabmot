<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCommissionAuditLog extends Model
{
    protected $table = 'agent_commission_audit_logs';

    protected $fillable = [
        'admin_id',
        'action',
        'subject_agent_id',
        'subject_tier_id',
        'description',
        'old_value',
        'new_value',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function subjectAgent()
    {
        return $this->belongsTo(Agent::class, 'subject_agent_id');
    }
}
