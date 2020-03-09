<?php

namespace App\Http\Controllers\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use app\Models\Banks;
use app\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DateTestController extends Controller
{
    public function index(){
        //测试查询
        //1.原生查询
//        $users=DB::select('select * from users where id=1');
//        dump($users);
        //获取所有行
        /*$users=DB::table('users')->get();
        dd($users);*/
        //获取单行,输出users数据库中的username字段的一个值
        /*$users=DB::table('users')->where('username','jiangxia')->first();
     echo $users->username;*/
        //获取一列的值
       /*$result=DB::table("users")->pluck('age');
        foreach($result as $res){
            echo $res.'<br/>';
        }*/
        //使用value方法从数据库中获取单个值（密码）
        /*$username=DB::table("users")->where('username','jiangxia')->value('password');
        return $username;*/
        //2、原生插入
//        $insert=DB::insert('insert into users（username,password,age,create_at,updated_at) values
//            ('xiaowu','123456',25,?,?)');
//            dump($insert);
        //3.原生更新
//        $result=DB::update('update users set username="jiangxia" where id<=200');
//        if($result) {
//            echo "数据更新成功！";
//        }
        //4、原生删除
//        $result=DB::delete('delete from users where id=205');
//        if($result){
//            echo "数据删除成功！";
//        }else{
//            echo "数据删除失败！";
//        }


        //分块结果
        /*DB::table('users')->orderBy('id')->chunk(100,function($users){
            foreach ($users as $user){

            }
        });*/
    }
}
