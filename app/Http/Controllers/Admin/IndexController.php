<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * 首页
 * Class IndexController
 * @package App\Http\Controllers\Admin
 * @author jiangxia
 * date 2020-03-02
 */
class IndexController extends BaseController
{
    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){


        return view("admin.index");
    }

    public function welcome(Request $request){


        return view("admin.welcome");
    }

    public function add(){
        return view("admin.index");
    }
}