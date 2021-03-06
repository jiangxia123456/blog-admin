<?php


namespace App\Http\Controllers\Logins;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Validator;

class LoginsController extends Controller
{
    //登录界面显示
    public function login(Request $request){
        return view("admins.login");
    }
    //实现登录验证

    public function toLogin(Request $request){
        //1、验证用户名username
        $user=User::where("username",$request->get("username"))->first();
        if(empty(($user))){
            echo "<script>alert('用户不存在！')</script>";
            return view("admins.login");
        }


        // 验证密码 password
        $password = $request->get("password").$request->get("username");
        $MD5password  = md5($password);
        if($MD5password != $user ->password){
            return view('admins.login', ["password_error_message"=>"密码错误！"]);
        }


        // 回到index首页
        return view("admins.index");
}


    //实现注册用户
    public function register(Request $request){
        //显示注册页面
        return view("admins.register");
    }
    //注册提交
    public function toRegister(Request $request){

        //进行表单验证
        $validator = Validator::make($request->all(),[
            'username'=>'required|alpha',
            'password'=>'required|between:6,12',
//            'password'=>'required|between:6-12',  错误一： 数字之间是逗号分割
            'captcha'=>'required|captcha'

        ],[     "username.required"=>"用户名不能为空",
                "username.alpha"=>"用户名不是全字母",
                "password.required"=>"密码不能为空",
                "password.between"=>"密码长度不符合",
                "captcha.required"=>"验证码不能为空",
                "captcha.captcha"=>"验证码错误"
        ]);

            //判断验证是否通过，如果没有通过，返回错误信息,并返回到注册界面
        if($validator->fails()){
            $error = $validator->errors()->toArray();
    //        $error = $validate>errors()->toArray();  // 错误二：仔细审核代码 箭头函数错误
            return view("admins.register", $error);
        }

    //判断用户名是否已经存在
        $username = User::where("username",$request->get("username"))->first();
        if($username==true){
            echo "<script>alert('用户名已经存在，请重新输入！')</script>";
            return view("admins.register");
        }

        //用户名通过之后，插入用户
        $user= new User();
        $username=$request->get("username");
//        $password=$request->get("password"); 错误三： 你要插入的密码需要md5加密
        $password = md5($request->get("password").$request->get("username"));
        $result = $user -> insert([
           "username"=>$username,
            "password"=>$password
        ]);


//        if($result->save()){  // 错误四：insert 和 save 都是插入数据  成功后的返回值是true
        if($result){
          echo "<script>alert('信息注册成功！')</script>";
          return view("admins.login");
       }else{
            echo "<script>alert('信息注册失败，请重新申请注册！')</script>";
        }
    }
    public function loginOut(){
        return view("admins.login");
    }
}