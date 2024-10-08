<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPermitPrice extends Model
{
    use HasFactory;
    public $fillable = [ 
        'permit_type_id',
        'amount',
    ];   
     
    public function otherPermitTypeInfo() 
    {
        return $this->belongsTo(OtherPermitType::class, 'permit_type_id', 'id');
    }
} 
