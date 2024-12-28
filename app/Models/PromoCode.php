<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_percentage',
        'start_datetime',
        'end_datetime',
        'usage_limit',
        'times_used', 
        'status',
    ];
    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
    ];
    

    public function isActive()
    {
        $now = now();
        return $this->status === 'active' &&
               $this->start_datetime <= $now &&
               $this->end_datetime >= $now &&
               ($this->usage_limit === null || $this->times_used < $this->usage_limit);
    }
}
 