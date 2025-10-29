<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //
    protected $fillable = [
        'activities',
        'article_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function articles(){
        return $this->belongsTo(Article::class);
    }
}
