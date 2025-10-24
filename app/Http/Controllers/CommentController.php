<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
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
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'comment' => 'sometimes|string',
            'article_id' => 'sometimes|integer|exists:articles,id',
            'user_id' => 'sometimes|integer|exists:users,id'
        ]);

        $data = array_filter($request->only(['comment', 'article_id', 'user_id']));

        return response()->json([
            'message' => 'comment succes updated',
            'data' => new CommentResource($this->commentService->updateComment($id,$data))
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
