<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Comment extends Model
{
    //
    protected $fillable = [
        'comment',
        'user_id',
        'article_id'
    ];

    public function articles(){
        return $this->belongsTo(Article::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
