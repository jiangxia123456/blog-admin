<?php


namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;


class ShowProfile extends Controller
{/*
*展示给定用户的资料
 * *
 * @param int $id
 * @return View
*/
    public function __invoke($id)
    {
        // TODO: Implement __invoke() method.
        return view ('user.profile',['user=>User::findOrFail($id)']);
    }

}