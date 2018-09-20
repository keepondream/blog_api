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
//获取基础信息
Route::get('basicinfo', function () {
    //        "https://blog.df5g.com/uploads/avatar/c41688bf9c9b0a109f17a85167ab5353.jpg",

    $bgurl = [
        "https://blog.df5g.com/uploads/avatar/fa1c74f53ffc379542c273a6e46f4eb5.jpg",
        "https://blog.df5g.com/uploads/avatar/221e41ac7c9ba0936c233037c78f456b.jpg",
        "https://blog.df5g.com/uploads/avatar/226b9d9312f6573036f4d132a26413bf.jpg",
        "https://blog.df5g.com/uploads/avatar/b245a92ce311cd966e8388d11da9a71a.jpg",
        "https://blog.df5g.com/uploads/avatar/612c7b735b5bd7d307fc6b692128f739.jpg",
        "https://blog.df5g.com/uploads/avatar/9b8d73ed649860a73f9496ebfafeba39.jpg",
    ];
    $int = mt_rand(0,5);

    return [
        "avatar" => "https://blog.df5g.com/uploads/avatar/6825dcb220b7ef0e575b5d20c78a0427.jpg",
        "name" => "孤岛渔夫",
        "blog" => "blog.df5g.com",
        "qq" => "402314889",
        "mobile" => "17621767677",
        "github" => "keepondream",
        "desc" => "找一个方向,定一个时间,剩下的只管努力!",
        "bgurl" => $bgurl[$int],
        "bgindex" => $int
    ];
});
//Route::post('articles', 'ArticleController@store');
//Route::put('articles/{article}', 'ArticleController@update');
//Route::delete('articles/{article}', 'ArticleController@delete');