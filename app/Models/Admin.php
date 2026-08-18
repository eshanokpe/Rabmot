<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
 
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'last_login', 'login_ip', 'otp',
        'role', 'status' // ✅ Status is present here
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mfa_enabled' => 'boolean',
        // Optional: If your status column uses 1/0 in the database, casting it to boolean is helpful
        // 'status' => 'boolean', 
    ];

    // --------------------------
    // ✅ ADD THIS METHOD
    // --------------------------
    public function isActive()
    {
        // OPTION 1: If your 'status' column is a string (e.g., 'active', 'inactive')
        // return $this->status === 'active';

        // OPTION 2: If your 'status' column is an integer/boolean (e.g., 1 = active, 0 = deactivated)
        return (bool) $this->status; 
    }

    // --------------------------
    // ✅ Role & Permission Checks
    // --------------------------
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function hasPermission(string $permission): bool
    {
        $permissions = [
            'view_orders'               => ['super_admin', 'admin'],
            'update_order_status'       => ['super_admin', 'admin'],
            'send_expiry_reminders'     => ['super_admin', 'admin'],
            'send_broadcast'            => ['super_admin', 'admin'],
            'manage_users'              => ['super_admin', 'admin'],
            'manage_agents'             => ['super_admin', 'admin'],
            'process_withdrawals'       => ['super_admin', 'admin'],
            'set_commission_rates'      => ['super_admin'],
            'set_service_pricing'       => ['super_admin'],
            'manage_admins'             => ['super_admin'],
            'view_financial_reports' => ['super_admin'],
            'delete_data'               => ['super_admin'],
        ];

        return in_array($this->role, $permissions[$permission] ?? []);
    }
}