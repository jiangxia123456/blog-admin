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

Route::get("/login","Login\AuthController@login");
Route::post("/toLogin","Login\AuthController@toLogin");
Route::get("/register","Login\AuthController@register");
Route::post("/toRegister","Login\AuthController@toRegister");
Route::get("/loginOut","Login\AuthController@loginOut");


Route::get("/logins","Logins\LoginsController@login");
Route::post("/toLogins","Logins\LoginsController@toLogin");
Route::get("/registers","Logins\LoginsController@register");
Route::post("/toRegisters","Logins\LoginsController@toRegister");


Route::prefix('admin')->group(function () {

});


Route::group([
    "prefix"=>"admin",
    'middleware' => ['loginAuth']
], function () {
    Route::get("/welcome","Admin\IndexController@welcome");
    Route::get("/index","Admin\IndexController@index");
    Route::get("/add","Admin\IndexController@add");
    Route::get("/article_list","Admin\ArticleController@list");
    Route::get("/article_add","Admin\ArticleController@created");
});