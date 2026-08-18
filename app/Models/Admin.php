<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
 
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'last_login', 'login_ip', 'otp',
        'role', 'status' 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mfa_enabled' => 'boolean',
    ];

    /**
     * Check if the admin account is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the admin is a super admin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

     public function hasPermission(string $permission): bool
    {
        // 1. Super admins bypass all permission checks and have access to everything
        if ($this->isSuperAdmin()) {
            return true;
        }

        // 2. IF YOU USE SPATIE LARAVEL-PERMISSION: 
        // Uncomment the line below and delete the rest of this method.
        // return $this->hasPermissionTo($permission);

        // 3. IF YOU STORE PERMISSIONS IN A DATABASE COLUMN (e.g., JSON or comma-separated string)
        if (isset($this->permissions)) {
            $userPermissions = is_string($this->permissions) 
                ? explode(',', str_replace(' ', '', $this->permissions)) 
                : (array) $this->permissions;
            
            return in_array($permission, $userPermissions, true);
        }

        // 4. FALLBACK: If you don't have a permissions column yet, 
        // you can temporarily return true to test, or add your custom logic here.
        return false;
    }
}