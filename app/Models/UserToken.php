<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    use HasFactory;
    protected $table = 'user_tokens';
    protected $fillable = ['user_id', 'referral_user_id', 'token_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
