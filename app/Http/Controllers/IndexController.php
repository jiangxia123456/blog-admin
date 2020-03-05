<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index(){
        return [
            "status_code"=>200,
            "message"=>"这是一个index界面",
            "data"=>[]
        ];
    }
}
