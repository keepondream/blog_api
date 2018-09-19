<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{

//200：OK，标准的响应成功状态码
//201：Object created，用于 store 操作
//204：No content，操作执行成功，但是没有返回任何内容
//206：Partial content，返回部分资源时使用
//400：Bad request，请求验证失败
//401：Unauthorized，用户需要认证
//403：Forbidden，用户认证通过但是没有权限执行该操作
//404：Not found，请求资源不存在
//500：Internal server error，通常我们并不会显示返回这个状态码，除非程序异常中断
//503：Service unavailable，一般也不会显示返回，通常用于排查问题用
    //分页请求
    public function index($page,$pagesize)
    {
        $page = intval($page);
        $pagesize = intval($pagesize);
        if ($page >= 0 && $pagesize > 0) {
            return Article::orderBy('updated_at','DESC')->skip($page * $pagesize)->take($pagesize)->get();
        }
        return response()->json(null,404);
//        return Article::all();
    }

    //详情
    public function show(Article $article)
    {
        if (!empty($article)) {
            $tail = $article->toArray();
            $tail['username'] = $article->user->name;
            $tail['catename'] = $article->category->name;
            return $tail;
        }
        return response()->json(null,404);
    }

    //最热文章分页请求
    public function hot($page, $pagesize)
    {
        $page = intval($page);
        $pagesize = intval($pagesize);
        if ($page >= 0 && $pagesize > 0) {
            return Article::orderBy('read_count','DESC')->skip($page * $pagesize)->take($pagesize)->get();
        }
        return response()->json(null,404);
    }

    //获取随机图片
    public function randpic($page, $pagesize)
    {
        $page = intval($page);
        $pagesize = intval($pagesize);
        if ($page >= 0 && $pagesize > 0) {
            $a = Article::orderBy('read_count','DESC')->skip($page * $pagesize)->take($pagesize)->get();
            $pic = [];
            foreach ($a as $v) {
                $pic[] = $v->list_pic;
            }
            return $pic;
        }
        return response()->json(null,404);
    }
    
    //获取评论
    public function comment($id)
    {
        $id = intval($id);
        return Comment::where('article_id',$id)->orderBy('updated_at','DESC')->get();
    }

//    public function store(Request $request)
//    {
//        $article = Article::create($request->all());
//
//        return response()->json($article, 201);
//    }
//
//    public function update(Request $request, Article $article)
//    {
//        $article->update($request->all());
//
//        return response()->json($article, 200);
//    }
//
//    public function delete(Article $article)
//    {
//        $article->delete();
//
//        return response()->json(null, 204);
//    }


}
