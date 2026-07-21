<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'commission_eligible',
        'commission_rate_override',
        'effective_date',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'commission_eligible' => 'boolean',
    ];

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
