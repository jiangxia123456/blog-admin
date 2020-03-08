<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{

    public function list(){

        // 按置顶 和 时间先后  每一页只需要十条数据 查询

        $data = Article::paginate(5);
        dd($data);

        return view("admin.article-list", ["data"=>$data, "username"=>"jiangxia"]);
    }

    public function created(){

        return view("admin.article-add");

    }

    public function updated(){

    }

    public function deleted(){
        // 删除文章

        // 成功跳会列表页
    }

    public function detail(){
        return view("article-detail");
    }

}
