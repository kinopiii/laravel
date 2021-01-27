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
//登録完了画面でPOSTされたとき
Route::post('/register_completed', 'member_registerController@completed')->name("complete.post");




//TOPページへ遷移
Route::get('/top', 'member_loginController@gettop')->name("top.show");
//ログインした際のTOPページへ
Route::post('/top', 'member_loginController@posttop')->name("top.post");



//パスワード再設定（メール送信）ページへ遷移
Route::get('/resetpw_send', 'member_loginController@getresetpw_send')->name("resetpw_send.show");
//パスワード再設定の送信ボタンがPOSTされたとき
Route::post('/resetpw_send', 'member_loginController@postresetpw_send')->name("resetpw_send.post");


//パスワード再設定（メール送信完了）ページへ遷移
Route::get('/resetpw_sent', 'member_loginController@getresetpw_sent')->name("resetpw_sent.show");
//パスワード再設定の送信ボタンがPOSTされたとき
Route::post('/resetpw_sent', 'member_loginController@postresetpw_sent')->name("resetpw_sent.post");


//パスワード再設定（パスワード設定）ページへ遷移
Route::get('/resettingpw', 'member_loginController@getresettingpw')->name("resettingpw.show");
//パスワード再設定のパスワードリセットがPOSTされたとき
Route::post('/resettingpw', 'member_loginController@postresettingpw')->name("resettingpw.post");



Route::get('/resettingpw', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/resettingpw', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');


//////////////////////////ログイン認証///////////////////////
Auth::routes();
//ログインページへ遷移
Route::get('/login', 'member_loginController@getlogin')->name("login.show");//->middleware('auth:members');
//ログインページでPOSTされたとき
Route::post('/login', 'member_loginController@postlogin')->name("login.post");
Route::post('/resetpw_send', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name("resetpw_send.post");


Route::get('/top', 'member_loginController@logout');


?>
