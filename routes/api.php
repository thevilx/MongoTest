<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('article/all' , [ArticleController::class , 'showAll']);
Route::get('/article/{article}' , [ArticleController::class , 'show']);
// Route::post('/article/add/category' , [ArticleController::class , 'addCategory']);
Route::post('/article/add/group' , [ArticleController::class , 'addToGroup']);

Route::post('/article/create' , [ArticleController::class , 'create']);
Route::post('/category/create' , [CategoryController::class , 'create']);
Route::post('/tag/create' , [TagController::class , 'create']);
