<?php

namespace App\Models;

// namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mfa_enabled' => 'boolean',
    ];

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

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
