<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentPasswordModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 
        'token', 
    ];

    public function user()
    {
        return $this->belongsTo(Agent::class);
    }
}
 