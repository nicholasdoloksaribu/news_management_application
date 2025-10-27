<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Jobs\ProcessCommentJob;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    public function index()
    {
        //
        $comments = Comment::with('user')->where('isDeleted', false)->paginate(5);
        return CommentResource::collection($comments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        //
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        ProcessCommentJob::dispatch($validated);

        return response()->json([
            'message'=> 'comment succes process',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return response()->json([
            'message' => 'comment finded',
            'data' => $this->commentService->showCommentById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        return response()->json([
            'message' => 'comment succes updated',
            'data' => new CommentResource($this->commentService->updateComment($id,$validated))
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
        $request->validate(
            ['id'=> 'integer|exists:comments,id']
        );

        return response()->json([
            'message' => 'comment succes deleted',
            'data' => new CommentResource($this->commentService->deleteComment($id))
        ]);        
    }
}
