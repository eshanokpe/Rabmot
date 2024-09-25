<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
		'topic_id',
        'comment_id',
        'content', 
        'author', 
        'author_pics',   
	];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
