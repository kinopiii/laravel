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



//ログアウトが押された場合TOPページへ
Route::post('/top', 'member_loginController@logout')->name("top.post");



//パスワード再設定（メール送信）ページへ遷移
Route::get('/resetpw_send', 'member_loginController@getresetpw_send')->name("resetpw_send.show");
//パスワード再設定の送信ボタンがPOSTされたとき
Route::post('/resetpw_send', 'member_loginController@getresetpw_sent')->name("resetpw_send.post");


//パスワード再設定（メール送信完了）ページへ遷移
Route::get('/resetpw_sent', 'member_loginController@getresetpw_sent')->name("resetpw_sent.show");


//商品登録ページを表示
Route::get('/products_register', 'products_registerController@getproduct_register')->name("products.show");

//商品登録ページでPOSTされたとき
Route::post('/products_register', 'products_registerController@postproducts')->name("products.post");

//商品登録確認画面を表示
Route::get('/products_confirm', 'products_registerController@getproduct_confirm')->name("productconfirm.show");

//商品登録確認ページでPOSTされたとき
Route::post('/products_confirm', 'products_registerController@postproduct_confirm')->name("productconfirm.post");

//商品リストページを表示
Route::get('/products_list', 'products_registerController@getproduct_list')->name("productslist.show");

//商品詳細ページを表示
Route::get('/products_detail/{id}', 'products_registerController@getproduct_detail')->name("productsdetail.show");

//////////////////////////ログイン認証///////////////////////
Auth::routes();
//ログインページへ遷移
Route::get('/login', 'member_loginController@getlogin')->name("login");//->middleware('auth:members');
//ログインページでPOSTされたとき
Route::post('/login', 'member_loginController@postlogin')->name("login.post");
Route::post('/resetpw_send', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name("resetpw_send.post");

//TOPページへ遷移
Route::get('/top', 'member_loginController@gettop')->name("top.show");


?>
