<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCommentJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $commentData;

    /**
     * Create a new job instance.
     */
    public function __construct($commentData)
    {
        //
        $this->commentData = $commentData;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Comment::create($this->commentData);
    }
}
