<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealersPlateNumberPrice extends Model
{
    use HasFactory;
    public $fillable = [
        'state_id', 
        'amount',
    ]; 
      
    public function stateInfo() 
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
