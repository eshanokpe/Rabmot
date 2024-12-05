<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model 
{ 
    use HasFactory;
    protected $fillable = [
		'process_id',
		'process_type',
        'paymentReference',
        'owner_id',
        'userType',
        'full_name', 
        'email', 

        'location',
        'lagos_address',
        'address',
        'delivery_option',
        'scan_email',
        'orderNo',

        'amount',  
        'trans_id', 
        'status', 
	];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
