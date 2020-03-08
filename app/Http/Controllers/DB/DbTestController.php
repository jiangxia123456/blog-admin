<?php

namespace App\Http\Controllers\DB;

use App\Models\Banks;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DbTestController extends Controller
{
    public function index(){
        // 90% 数据库优化 重点是在查询  表设计 索引设计 关系型设计

        // 插入语句
        // 第一种 DB形式
        // 单条插入

//        $data = [
//            "username"=>"jiangxia",
//            "password"=>"123456",
//            "age"=>"18",
//            "created_at"=>date("Y-m-d H:i:s")
//        ];
//        $data = [];
//        for ($i=0;$i < 100; $i++){
//            $data[] = [
//                "username"=>"jiangxia".($i+3),
//                "password"=>"123456",
//                "age"=>"18",
//                "created_at"=>date("Y-m-d H:i:s")
//            ];
//        }
//        // 插入成功 返回true 否则返回false
//        $result = DB::table("users")->insert($data);

//        $result = DB::table("users")->insertGetId($data); // 插入返回ID

//        $data = [
//            [
//                "username"=>"jiangxia1",
//                "password"=>"123456",
//                "age"=>"20",
//                "created_at"=>date("Y-m-d H:i:s")
//            ],
//            [
//                "username"=>"jiangxia2",
//                "password"=>"123456",
//                "age"=>"21",
//                "created_at"=>date("Y-m-d H:i:s")
//            ]
//        ];
//        $result = DB::table("users")->insert($data);
        // 第二 对象形式
        $users = new Users();
//
//        $users ->username = "xiaowu";
//        $users->password = "123456";
//        $users->age = "25";
//
//        $result = $users->save();



        // 更新
//        DB::table("users")->where("username", "xiaowu")->update([
//            "password"=>"654321"
//        ]);

//        $users ->where("username", "jiangxia")->update([
//            "password"=>"654321"
//        ]);
        // 自增
//        $result = DB::table('users')->where("username", "jiangxia")->increment('age', 3);
        // 自减
//        $result = DB::table('users')->where("username", "jiangxia")->decrement('age', 3);
//
//         删除
//        DB::table("users")->where("username", "xiaowu")->delete();
//
//        $users ->where("username", "jiangxia")->delete();

        // 事务操作 重点  myisam 不支持事务 不走事务逻辑  innodb 支持事务
//        $banks = new Banks();
//
//        DB::beginTransaction();
//
//        $InsertResult = $banks->insert([
//            "number"=>"6276273726327111",
//            "user_id"=>1,
//            "created_at"=>date("Y-m-d H:i:s")
//        ]);
//
//        if(!$InsertResult){
//            DB::rollBack(); // 回滚 回到进程最初的状态
//        }
//
//        $updateResult = $users->where("id",1)->increment('banks_num', 1);
//
//        if(!$updateResult){
//            DB::rollBack();
//        }
//
//        // 只有走到这一步 提交事务 数据库才会变化 走不到这里 一切的数据操作都是徒劳
//        DB::commit();

        // 查询
        // 查询一条数据 where 条件 select 字段
//        $user = DB::table("users")->where("username", "jiangxia")->select("id", "username","password")->first();

        // 查询多条
//        $page = 1  2  3 4
//                0 10 20 30
//
//        $page = $request ->get("page");
//        $num = $page - 1 * 10;

        $userList = $users
                ->offset(0)
                ->limit(10)
            ->get();
//
//        echo "<table style='border:1px solid red'>";
//        echo "<tr><th style='border:1px solid red'>用户名</th style='border:1px solid red'><th>密码</th></tr>";
//        foreach ($userList as $key=>$item){
//            echo "<tr><td style='border:1px solid red'>{$item->username}</td><td style='border:1px solid red'>{$item->password}</td></tr>>";
//        }
//        echo "</table>";


//        dd($userList);
    }


}
