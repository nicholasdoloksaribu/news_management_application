<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//Article Routes

Route::middleware('auth:api')->group( function(){
Route::get('/news', [ArticleController::class, 'index']);
Route::post('/news', [ArticleController::class, 'store'])->middleware('check.admin');
Route::get('/news/{id_article}', [ArticleController::class, 'show']);
Route::post('/news/{id_article}', [ArticleController::class, 'update'])->middleware('check.admin');
Route::delete('/news/{id_article}',[ArticleController::class, 'destroy'])->middleware('check.admin');

//Comment Routes
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/comments', [CommentController::class, 'index']);
Route::get('/comments/{id_comment}', [CommentController::class, 'show']);
Route::put('/comments/{id_comment}', [CommentController::class, 'update']);
Route::delete('/comments/{id_comment}', [CommentController::class, 'destroy']);

//History Routes
Route::get('/histories', [HistoryController::class, 'index']);
Route::post('/logout', [LogoutController::class, 'logout']);

});
//Login Route
Route::post('/login', [LoginController::class, 'login']);