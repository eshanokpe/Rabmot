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
        'full_name', 
        'email', 
        'amount',  
        'trans_id', 
        'status', 
	];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
