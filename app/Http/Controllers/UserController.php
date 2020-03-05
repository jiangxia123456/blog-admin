<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
 public function index(){
        return [
            "status_code"=>300,
            "message"=>"ll",
            "data"=>[]
        ];
    }
    /*
     *显示给定用户的概要文件
     *
     * @param int $id
     * @return View
     */
    public function show($id){
        dd($id);
        return view('user.profile',['user'=>User::findOrFail($id)]);
    }
}
