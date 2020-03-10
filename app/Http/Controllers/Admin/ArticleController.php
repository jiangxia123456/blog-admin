<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function list(){
        // 按置顶 和 时间先后  每一页只需要十条数据 查询

        $data = Article::orderBy("top_num", "desc")->orderBy("created_at" ,"desc")->paginate(5);
//        dd($data->links());
        return view("admin.article-list", ["data"=>$data, "username"=>"jiangxia"]);
    }

    public function created(){

        // 标签列表
        $tags = Tag::select("id", "tag_name")->orderBy("id","asc")->get();

        //分类列表
        $category = Category::select("id","name")->get();

       //作者列表
        $users = User::select("id","username")->get();

        return view("admin.article-add", ["tags"=>$tags,"category"=>$category,"users"=>$users]);
    }
    public function toCreated(Request $request){
        DB::beginTransaction();
        // 插入一条文章
        $articleData= [
            "title"=>$request->get("title"),
            "content"=>$request->get("ueditor"),
            "top_num"=>$request->get("top"),
            "status"=>$request->get("status"),
            "user_id"=>$request->get("author"),
            "created_at"=>date("Y-m-d H:i:s")
        ];
        $articleId = Article::insertGetId($articleData);
        if(!$articleId){
            DB::rollBack();
            echo "<script>alert('数据插入失败');history.back()</script>";
        }

        // 插入一个标签
        $result = DB::table("article_tag")->insert([
            "article_id"=>$articleId,
            "tag_id"=>$request->get("tag")
        ]);
        if(!$result){
            DB::rollBack();
            echo "<script>alert('数据插入失败');history.back()</script>";
        }

        // 插入分类
        $result = DB::table("article_category")->insert([
                "article_id"=>$articleId,
            "category_id"=>$request->get("sort")
        ]);
        if(!$result){
            DB::rollBack();
            echo "<script>alert('数据插入失败');history.back()</script>";
        }

        DB::commit();
        return redirect('admin/article_list');
    }

    public function updated(Request $request){
        //查询user数据表中的id,username的字段值
        $user = DB::table("user")->select("id","username")->get();
        //通过获取传递过来的ID
        $id=$_GET['id'];
        //$id = $request->get("id");
        $result = DB::table("article")->where("id" ,$id)->first();
        //获取分类
        $category=DB::table("category")->select("id","name")->get();
        //获取id
        $categoryId=DB::table("article_category")->where("article_id", $id)->value("category_id");
        //获取标签
        $tag=DB::table("tag")->select("id","tag_name")->get();
        //获取ID
        $tagId=DB::table("article_tag")->where("article_id",$id)->value("tag_id");

        return view("admin.article-edit",["result"=>$result,"users"=>$user,"category"=>$category,
            "category_id"=>$categoryId,"tag"=>$tag,"tagId"=>$tagId]);
    }

    public function toUpdated(Request $request){
        //获取传入过来的字段值
        $title=$request->get("title");
        $content=$request->get('ueditor');
        $read_number=$request->get('read_number');
        $top_num=$request->get("top_status");
        $status=$request->get("status");
        $author=$request->get("author");
        //用数组的形式对article数据表相应的字段进行赋值
        $addData = [
            "title"=>$title,
            "content"=>$content,
            "read_number"=>$read_number,
            "top_num"=>$top_num,
            "status"=>$status,

            "updated_at"=>date("Y-m-d H:i:s"),
            "user_id"=>$author
        ];
        //dd($addData,$request->all());
        //把数据插入到数据表中
        $result= DB::table("article")->insert($addData);
        if($result){
            echo "<script>alert('数据插入成功');</script>";
            return redirect('admin/article_list');
        }else{
            echo "<script>alert('数据插入失败');history.back()</script>";
        }
    }

    // 修改标题
    public function articleUpdateTitle(Request $request){
        if(!Article::where("id", $request->get("id"))->update([
            "title"=>$request->get("title")
        ])){
           return [
               "code"=>400,
               'message'=>"数据修改失败啦！！！"
           ];
        };

        return [
            "code"=>200,
            "message"=>"终于成功啦！"
        ];
        dd($request->all());
    }


    public function deleted(Request $request){
        DB::beginTransaction();
        $result=DB::table("article")->where("id",$request ->get("id"))->delete();
        if(!$result){
            DB::rollBack();
            return [
                "code"=>400,
                "message"=>"删除失败"
            ];
        }

        // 删除分类关联表
        $result = DB::table("article_category")->where("article_id",$request ->get("id"))->delete();
        if(!$result){
            DB::rollBack();
            return [
                "code"=>400,
                "message"=>"删除失败"
            ];
        }
        //删除标签关联表
        $result = DB::table("article_tag")->where("article_id",$request->get("id"))->delete();
        if(!$result){
            DB::rollBack();
            return [
                "code"=>400,
                "message"=>"删除失败"
            ];

        }

        DB::commit();
        return [
            "code"=>200,
            "message"=>"删除成功"
        ];

    }


    public function detail(){
        return view("article-detail");
    }

}
