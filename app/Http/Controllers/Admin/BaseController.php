<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {
        //验证
//        if(empty($_SESSION["username"])){
//            dd("无权限");
//        }
//
//        $username = $_SESSION["username"];
//
//        if(empty($_SESSION[$username])){
//            dd("无权限");
//        }

    }
}