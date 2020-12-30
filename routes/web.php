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
//Welcomeページなので、コメントアウト
/*Route::get('/', function () {
    return view('welcome');
});*/

//会員登録
Route::get('/', 'member_registerController@getmember_register')->name("form.show");
//POSTされたときのルーティング
Route::post('/', 'member_registerController@post')->name("form.post");

//登録確認
Route::get('/register_confirm', 'member_registerController@confirm')->name("form.confirm");
//確認画面から登録完了画面へ
Route::post('/register_confirm', 'member_registerController@register')->name("form.register");

//登録完了
Route::get('/register_completed', 'member_registerController@getregister_completed')->name("form.complete");



?>
