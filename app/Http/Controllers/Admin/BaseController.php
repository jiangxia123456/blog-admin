<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use http\Env\Request;
use MongoDB\Driver\Session;

class BaseController extends Controller
{
    public function __construct()
    {
        // 验证
//        echo '验证';


    }
}