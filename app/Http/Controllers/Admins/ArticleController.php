<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function list(){
        return view("admins.article-list");
        // 按置顶 和 时间先后  每一页只需要十条数据 查询
        $result=DB::select("select * from article");
        if(!$result){
            return "数据查询失败！";
        }
            foreach($result as $row){
               echo  $row['title'];
               echo  $row['content'];
               echo $row['read_number'];
               echo  $row['top_num'];
               echo  $row['status'];
               echo  $row['create_at'];
               echo $row['updated_at'];
               echo $row['user_id'];
            }




    }

    public function created(){


        return view("admins.article-add");

    }

    public function updated(){

    }

    public function deleted(){
        // 删除文章

        // 成功跳会列表页
    }

    public function detail(Request $request){
        return view("admins.article-detail");
    }

}
