<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request){

        return view('login');
    }

    public function toLogin(Request $request){

//        $user = DB::table("user")->first();

//        $user = User::where("username", $request->get("username"))->first();
        dd(DB::table("author")->get());

        dd($request->all());
    }
}
