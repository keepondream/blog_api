<?php

use Illuminate\Http\Request;
use App\Models\Article;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//分页获取
Route::get('articles/{page}/{pagesize}', 'ArticleController@index');
//获取详情
Route::get('tail/{article}', 'ArticleController@show');
//获取评论
Route::get('comment/{article}', 'ArticleController@comment');
//获取最热
Route::get('hot/{page}/{pagesize}','ArticleController@hot');
//获取随机图片
Route::get('randpic/{page}/{pagesize}','ArticleController@randpic');
//Route::post('articles', 'ArticleController@store');
//Route::put('articles/{article}', 'ArticleController@update');
//Route::delete('articles/{article}', 'ArticleController@delete');