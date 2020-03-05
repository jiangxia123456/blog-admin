<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class IndexController extends BaseController
{
    // 首页
    public function index(Request $request){



        return view("admin.index");
    }

    public function add(){

    }
}