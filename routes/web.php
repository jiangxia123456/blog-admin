<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//	return [
//		"status_code"=>200,
//		"message"=>"welcome"
//	];
//	## json xml api
//    return view('welcome');
//});

//(new IndexController())->index()

// 数据库操作
Route::get("/db/index","DB\DbTestController@index");
Route::get("/index","DB\DateTestController@index");

// 登录注册模块
Route::get("/login","Login\AuthController@login");
Route::post("/toLogin","Login\AuthController@toLogin");
Route::get("/register","Login\AuthController@register");
Route::post("/toRegister","Login\AuthController@toRegister");
Route::get("/loginOut","Login\AuthController@loginOut");


// 后台模块
Route::group([
    "prefix"=>"admin",
    'middleware' => ['loginAuth']
], function () {
    Route::get("/welcome","Admin\IndexController@welcome");
    Route::get("/index","Admin\IndexController@index");
    Route::get("/add","Admin\IndexController@add");
    Route::get("/article_list","Admin\ArticleController@list");
    Route::get("/article_add","Admin\ArticleController@created");
    Route::post("to_article_add","Admin\ArticleController@toCreated");
    Route::get("/article_edit","Admin\ArticleController@updated");
    Route::post("/to_atricle_edit","Admin\ArticleController@toUpdated");
    Route::get("/article_delete","Admin\ArticleController@deleted");
    Route::post("/article_update_title","Admin\ArticleController@articleUpdateTitle");

});

//
//Route::get("/logins","Logins\LoginsController@login");
//Route::post("/toLogins","Logins\LoginsController@toLogin");
//Route::get("/registers","Logins\LoginsController@register");
//Route::post("/toRegisters","Logins\LoginsController@toRegister");
//Route::get("/loginOuts","Logins\LoginsController@loginOut");
//
//
//
//
//Route::prefix('admins')->group(function () {
//
//    Route::get("/welcome","Admins\IndexController@welcome");
//    Route::get("/index","Admins\IndexController@index");
//    Route::get("/add","Admins\IndexController@add");
//    Route::get("/article_list","Admins\ArticleController@list");
//    Route::get("/article_add","Admins\ArticleController@created");
//});





