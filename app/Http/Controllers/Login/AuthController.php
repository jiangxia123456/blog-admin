<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

/**
 * 登录注册
 * Class AuthController
 * @package App\Http\Controllers\Login
 * @author jiangxia
 * date 2020-03-02
 */
class AuthController extends Controller
{
    /**
     * 登录页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request){

        return view('admin.login');
    }

    /**
     * 登录
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function toLogin(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required|regex:/^1[345678]\d{9}$/',
            'password' => 'required|between:6,12',
        ],[
            "username.required"=>"手机号不能为空",
            "username.regex"=>"手机号码不符合规则",
            "password.required"=>"密码不能为空",
            "password.between"=>"密码长度不符合规则"

        ]);

        if($validator->fails()){
            $error = $validator->errors()->toArray();
            return view("admin.login", $error);
        }

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
        $_SESSION["username"] = $request->get("username");
        $_SESSION[$request->get("username")] = true;

        // 重定向到首页
        return redirect("admin/index");

    }


    /**
     * 注册页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(Request $request){

        return view("admin.register");
    }

    /**
     * 提交注册信息
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function toRegister(Request $request){
        // 表单验证单
        $validator = Validator::make($request->all(), [
            'username' => 'required|regex:/^1[345678]\d{9}$/',
            'password' => 'required|between:6,12',
            "captcha" => "required|captcha"
        ],[
            "username.required"=>"手机号码不能为空",
            "username.regex"=>"手机号码不符合规则",
            "password.required"=>"密码不能为空",
            "password.between"=>"密码长度不符合规则",
            "captcha.required"=>"验证码不能为空",
            "captcha.captcha"=>"验证码错误"

        ]);

        if($validator->fails()){
            $error = $validator->errors()->toArray();
            return view("admin.register", $error);
        }

        // 判断用户名是否存在了数据库里面
        $user = User::where("username", $request->get("username"))->first();
        if($user){
            echo "<script>alert('信息注册失败！')</script>";
            return view("admin.register");
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

        /**
         * User::where("username", $request->get("username")); 这个是获取了username = $request->get("username") 的数据资源
         * User::where("username", $request->get("username"))->first() 这个是获取username = $request->get("username") 的单条数据
         * User::where("username", $request->get("username"))->get() 这个是获取username = $request->get("username")的所有或者多天数据
         */

        /**
         * 这里需要判断前端传过来的username 和我们数据库查询出来的username做对比
         * $request->get("username") 前端传过来的数据库
         * $user = User::where("username", $request->get("username"))->first()  获取username =$request->get("username") 的数据
         * 如果 $user 不等于null 证明数据已经存在的  这时候我们要给她提示说 用户们已存在了，不需要重复注册
         * 相反 则证明这个username 还没存在我们数据库中可以让他提交
         */


        return redirect("/login");
    }


    /**
     * 退出登录
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginOut(){
        $username = $_SESSION["username"];
        $_SESSION[$username] = '';
        $_SESSION["username"] = "";
        return redirect("/login");
    }
}
