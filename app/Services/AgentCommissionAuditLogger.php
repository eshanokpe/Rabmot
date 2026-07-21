<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\AgentCommissionAuditLog;

class AgentCommissionAuditLogger
{
    public function log(
        Admin $admin,
        string $action,
        string $description,
        ?string $oldValue = null,
        ?string $newValue = null,
        ?int $subjectAgentId = null,
        ?int $subjectTierId = null
    ): AgentCommissionAuditLog {
        return AgentCommissionAuditLog::create([
            'admin_id' => $admin->id,
            'action' => $action,
            'subject_agent_id' => $subjectAgentId,
            'subject_tier_id' => $subjectTierId,
            'description' => $description,
            'old_value' => $oldValue,
            'new_value' => $newValue,
        ]);
    }
}
