<?php


namespace App\Http\Controllers\Admins;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class IndexController extends Controller
{
    // 首页
    public function index(Request $request){

//        var_dump(Session::get("username"));

        return view("admins.index");
    }

    public function welcome(Request $request){

//        var_dump(Session::get("username"));

        return view("admins.welcome");
    }

    public function add(){
        return view("admins.index");
    }
}