<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory; 
    protected $fillable = [
        'user_id',
        'user_email',
        'owner_id',
        'userType',
        'order_number',
        'process_id', 
        'product_name',
        'product_amount',
        'product_qty',
        'total', 
    ]; 
}
