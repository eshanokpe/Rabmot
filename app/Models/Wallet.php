<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'user_email', 
        'userType',
        'amount',
        'bank',
        'account_number',
        'account_name',
        'status'
    ];
}
