<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }
    public function index()
    {
        //
        $articles = Article::with('user')->where('isDeleted', 0)->paginate(5);
        return ArticleResource::collection($articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
       
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        //
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;

        $article = $this->articleService->createArticle($validated, $request->file('image'));

        return response()->json([
           'message' => 'Article created success',
            'data' => new ArticleResource($article)
        ],201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $article = Article::with(['comments','user'])->where('isDeleted', 0)->findOrFail($id);
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        //


        $validated = $request->validated();
        $article = $this->articleService->updateArticle($id,$validated);

        return response()->json([
            'message'=> 'Article Success Update',
            'data'=> new ArticleResource($article)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        return response()->json([
            'message' => 'Article success deleted',
            'data' => new ArticleResource($this->articleService->deleteArticle($id))
        ],200);
    }
}
