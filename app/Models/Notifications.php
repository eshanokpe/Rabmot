<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_email',
        'fullname',
        'userType',
        'title',
        'message',
        'read_at'
    ];
}
 