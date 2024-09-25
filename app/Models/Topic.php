<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
		'topic_id',
        'title',
        'content', 
        'author', 
        'author_pics',   
	];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
