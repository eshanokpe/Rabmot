<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{ 
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname', 
        'phone',
        'state',
        'role',
        'email',
        'email_token',
        'verified',
        'phone',
        'address',
        'profile_image',
        'gender',
        'address',
        'status_id',
        'status',
        'password',
        'know_us',
        'referred_by',
        'referral_code',
        'referralsCount',
        'referrer_count'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function passwordModel()
    {
        return $this->hasOne(PasswordModel::class);
    }

    public function referralsCount()
    {
        return $this->hasMany(User::class, 'referred_by')->count();
    }


    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }
    
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function tokens(){
        return $this->hasMany(UserToken::class);
    }

    public function latestTokenCount()
    {
        return $this->tokens()->latest()->value('token_count') ?? 0;
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function addToWallet($amount)
    {
         $wallet = $this->wallet; 

        if ($wallet) {
            $wallet->amount += $amount; 
            $wallet->save(); 
        } else {
            $this->wallet()->create([
                'amount' => $amount,  
                'user_email' => $this->email,
                'userType' => 'user',
                'status' => 0

            ]);
        }
    }

}
