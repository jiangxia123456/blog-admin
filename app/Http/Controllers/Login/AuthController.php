<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;

class AuthController extends Controller
{
    public function login(Request $request){

        return view('admin.login');
    }

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function toLogin(Request $request){

        // 验证用户 username
        $user = User::where("username", $request->get("username"))->first();
        if(empty($user)){
            return view('admin.login', ["username_error_message"=>"用户名不存在！"]);
        }


        // 验证密码 password
        $password = $request->get("password").$request->get("username");
        $MD5password  = md5($password);
        if($MD5password != $user ->password){
            return view('admin.login', ["password_error_message"=>"密码错误！"]);
        }

        // 设置一个session 作为权限验证
//        session($request->get("username")."_ver_session", "true");
//        session("username", $request->get("username"));

        // 验证验证码

        // 重定向到首页
        return redirect("admin/index");

    }


    // 注册
    public function register(Request $request){


        return view("admin.register");
    }

    // 提交注册
    public function toRegister(Request $request){
        // 表单验证单
        $validator = Validator::make($request->all(), [
            'username' => 'required|between:6,12',
            'password' => 'required|between:6,12',
            "captcha" => "required|captcha"
        ],[
            "username.required"=>"用户名不能为空",
            "username.between"=>"用户名长度不符合规则",
            "password.required"=>"密码不能为空",
            "password.between"=>"密码长度不符合规则",
            "captcha.required"=>"验证码不能为空",
            "captcha.captcha"=>"验证码错误"

        ]);

        if($validator->fails()){
            $error = $validator->errors()->toArray();
            return view("admin.register", $error);
        }

        // 通过之后

        // 加密密码 md5 + 盐值
        $password = md5($request->get("password").$request->get("username"));
        // 第一种
        $user = new User();
        $user ->username = $request->get("username");
        $user ->password = $password;
        if(!$user->save()){
            echo "<script>alert('信息注册失败！')</script>";
            return view("admin.register");
        }else{

            echo "<script>alert('信息注册成功！')</script>";
            return view("admin.login");

        }

        /* 判断注册时用户名是否已经存在

               */
        $user1 = User::where("username", $request->get("username"));
        if($user->username==$user1->username){
            echo "<script>alert('用户名已存在，请重新注册！')</script>";

        }else{
            return view("admin.login");
        }


//        $result = $user -> insert([
//            "username"=>$request->get("username"),
//            "password"=>$password
//        ]);
//        if(!$result){
//            // 处理
//        }

//        dd($request->all());


        return redirect("/login");
    }
}
