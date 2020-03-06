<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends BaseController
{
    // 首页
    public function index(Request $request){

//        var_dump(Session::get("username"));

        return view("admin.index");
    }

    public function add(){
        return view("admin.index");
    }
}