<?php

namespace App\Http\Controllers\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use app\Models\Banks;
use app\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Arg;

class DateTestController extends Controller
{
    public function index()
    {
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
        //获取一列的值（有问题）
//       $result=DB::table("users")->pluck('username',"id");
//        foreach($result as $key=>$res){
//            echo $key."=>".$res.PHP_EOL;
//        }
        //使用value方法从数据库中获取单个值（密码）
        /*$username=DB::table("users")->where('username','jiangxia')->value('password');
        return $username;*/
        //2、原生插入（有问题）
//        $dateTime = date("Y-m-d H:i:s");
//        $insert=DB::insert("insert into users(username,`password`,age,created_at) values ('xiaowu','123456',25,?)",[date("Y-m-d H:i:s")]);
//          dump($insert);
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

        //聚合
        //1.返回总共记录条数
        /*$users=DB::table('users')->count();
        return $users;*/
        //2、返回users数据表中age字段中最大的值
       /* $users1=DB::table('users')->max('age');
        return $users1;*/
       //3.判断查询条件的结果是否存在(有问题）
        $result= DB::table('users')->where('id',1)->exists();
//        dd($result);
//        if($result){
//            return true;
//        }



       //Selects语句
        //1.指定字段查询
        /*$users=DB::table('users')->select('username','password','age')->get();
        dump($users);*/
        //disinct方法强制查询返回的结果不重复
        /*$users=DB::table('users')->distinct()->get();
        dump($users);*/


        //Joins
//        $users=DB::table('users')
//            ->join('banks','users.id','=',banks.id');


//        DB::table('users')->where("username", "xiaowu1")->orderBy('id')->chunk(1, function ($users) {
//            foreach ($users as $user) {
////                dump($user);
//            }
//        });
    }
}
