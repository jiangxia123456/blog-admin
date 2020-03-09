<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function list(){

        // 按置顶 和 时间先后  每一页只需要十条数据 查询

        $data = Article::paginate(5);

        return view("admin.article-list", ["data"=>$data, "username"=>"jiangxia"]);
    }

    public function created(){

        return view("admin.article-add");

    }

    public function updated(){
    $id=$_GET['id'];
        $result=DB::table("article")->where("id" ,$id)->select()->get();
        return view("admin.article-edit",["result"=>$result]);
    }
public function toUpdated(Request $request){
        $title=$request->get("title");
        $content=$request->get('content');
        $red_number=$request->get('red_num');
        $top_status=$request->get("top_status");
        $status=$request->get("status");
        $create_at=$request->get("create_at");
        $updated_at=$request->get("updated_at");
        $author=$request->get("author");
      $result= DB::table("article")->insert([
            "title"=>$title,
                "content"=>$content,
                "red_number"=>$red_number,
                "top_status"=>$top_status,
                "status"=>$status,
                "create_at"=>$create_at,
                "updated_at"=>$updated_at,
                "author"=>$author
            ]
        );
if($result){
    echo "<script>alert('数据插入成功')</script>";
}else{
    echo "<script>alert('数据插入失败');history.back()</script>";
}
    }



    public function deleted(){
        // 删除文章
        $id=$_GET['id'];
        $result=DB::table("article")->where("id",$id)->delete();
        if($result){
            echo "<script>alert('删除成功！');history.back()</script>";
        }else{
            echo "<script>alert('删除失败！');history.back()</script>";

        }

        // 成功跳会列表页
    }

    public function detail(){
        return view("article-detail");
    }

}
