<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\History;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        //
        History::create([
            'activities' => 'created article',
            'article_id' => $article->id,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        //
        if ($article->isDirty('isDeleted')) {
            # code...
            if ($article->isDeleted == 1) {
                # code...
                History::create([
                    'activities' => 'deleted article',
                    'article_id' => $article->id,
                    'user_id' => auth()->user()->id
                ]);
            } else if($article->isDeleted == 0){
                
                History::create([
                    'activities' => 'restored article',
                    'article_id' => $article->id,
                    'user_id' => auth()->user->id
                ]);
            }
        }
        else{
                History::create([
                'activities' => 'updated article',
                'article_id' => $article->id,
                'user_id' => auth()->user()->id
            ]);
    }

        
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        //
        // History::create([
        //     'activities' => 'deleted article',
        //     'article_id' => $article->id,
        //     'user_id' => auth()->user()->id
        // ]);
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        //
    }
}
