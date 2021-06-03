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


/*
|--------------------------------------------------------------------------
| 会員登録
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| 商品登録
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| 商品レビュー
|--------------------------------------------------------------------------
*/

//商品レビュー登録画面を表示
Route::get('/review_register/{id}', 'products_registerController@getreview_register')->name("reviewregister.show");

//商品レビュー登録画面でPOSTされた
Route::post('/review_register/{id}', 'products_registerController@postreview_register')->name("reviewregister.post");

//商品レビュー登録確認画面を表示
Route::get('/review_confirm/{id}', 'products_registerController@getreview_confirm')->name("reviewconfirm.show");

//商品レビュー登録確認画面でPOSTされた
Route::post('/review_confirm/{id}', 'products_registerController@postreview_confirm')->name("reviewconfirm.post");

//商品レビュー登録完了画面を表示
Route::get('/review_complete/{id}', 'products_registerController@getreview_complete')->name("reviewcomplete.show");

//商品レビュー一覧画面を表示
Route::get('/review_list/{id}', 'products_registerController@getreview_list')->name("reviewrlist.show");

/*
|--------------------------------------------------------------------------
| マイページ
|--------------------------------------------------------------------------
*/
//マイページを表示
Route::get('/mypage', 'mypageController@getmypage')->name("mypage.show");

//マイページで「退会｣ボタンが押されたとき
Route::post('/mypage', 'mypageController@postmypage')->name("mypage.post");

//退会ページを表示
Route::get('/withdrawal', 'mypageController@getwithdrawal')->name("withdrawal.show");

//退会ページで「退会する｣が押されたとき
Route::post('/withdrawal', 'mypageController@postwithdrawal')->name("withdrawal.post");

//会員情報変更ページを表示
Route::get('/changeinfo', 'mypageController@getchangeinfo')->name("changeinfo.show");

//会員情報変更ページで「確認画面へ｣が押されたとき
Route::post('/changeinfo', 'mypageController@postchangeinfo')->name("changeinfo.post");

//会員情報変更確認ページを表示
Route::get('/confirminfo', 'mypageController@getconfirminfo')->name("confirminfo.show");

//会員情報変更確認ページでPOST
Route::post('/confirminfo', 'mypageController@postconfirminfo')->name("confirminfo.post");

//パスワード変更ページを表示
Route::get('/changepass', 'mypageController@getchangepass')->name("changepass.show");

//パスワード変更ページでPOST
Route::post('/changepass', 'mypageController@postchangepass')->name("changepass.post");

//メールアドレス変更ページを表示
Route::get('/changemail', 'mypageController@getchangemail')->name("changemail.show");

//メールアドレス変更ページでPOST
Route::post('/changemail', 'mypageController@postchangemail')->name("changemail.post");



//メールアドレス変更認証完了ページを表示
Route::get('/completemail', 'mypageController@getcompletemail')->name("completemail.show");

//メールアドレス変更認証完了ページでPOST
Route::post('/completemail', 'mypageController@postcompletemail')->name("completemail.post");



//商品レビュー管理ページを表示
Route::get('/review_manage', 'mypageController@getreview_manage')->name("review_manage.show");

//商品レビュー管理ページでPOST
Route::post('/review_manage', 'mypageController@postreview_manage')->name("review_manage.post");

//商品レビュー編集ページを表示
Route::get('/review_edit/{id}', 'mypageController@getreview_edit')->name("reviews_edit.show");

//商品レビュー編集ページでPOST
Route::post('/review_edit/{id}', 'mypageController@postreview_edit')->name("reviews_edit.post");

//商品レビュー編集確認ページを表示
Route::get('/mypage_review_confirm/{id}', 'mypageController@getreview_confirm')->name("reviews_confirm.show");

//商品レビュー編集確認ページでPOST
Route::post('/mypage_review_confirm/{id}', 'mypageController@postreview_confirm')->name("reviews_confirm.post");

//商品レビュー削除確認ページを表示
Route::get('/review_delete/{id}', 'mypageController@getreview_delete')->name("reviews_delete.show");

//商品レビュー削除確認ページでPOST
Route::post('/review_delete/{id}', 'mypageController@postreview_delete')->name("reviews_delete.post");

/*
|--------------------------------------------------------------------------
| 管理者機能
|--------------------------------------------------------------------------
*/
//管理者ログインフォームを表示
Route::get('/manage_login', 'ManagementController@getlogin')->name("manage_login.show");

//管理者ログインフォームでPOST
Route::post('/manage_login', 'ManagementController@postlogin')->name("manage_login.post");

//管理者トップページを表示
Route::get('/manage_top', 'ManagementController@gettop')->name("manage_top.show");

//管理者トップページでPOST
Route::post('/manage_top', 'ManagementController@posttop')->name("manage_top.post");

//会員一覧ページを表示
Route::get('/member_list', 'ManagementController@getmember_list')->name("member_list.show");

//会員一覧ページでPOST
Route::post('/member_list', 'ManagementController@postmember_list')->name("member_list.post");

//会員登録ページを表示
Route::get('/manage_member_register', 'ManagementController@getmember_register')->name("manage_member_register.show");

//会員登録ページでPOST
Route::post('/manage_member_register', 'ManagementController@postmember_register')->name("manage_member_register.post");

//会員編集ページを表示
Route::get('/manage_member_edit/{id}', 'ManagementController@getmember_edit')->name("manage_member_edit.show");

//会員編集ページでPOST
Route::post('/manage_member_edit', 'ManagementController@postmember_edit')->name("manage_member_edit.post");

//会員登録/編集確認ページを表示
Route::get('/manage_member_confirm', 'ManagementController@getmember_confirm')->name("manage_member_confirm.show");

//会員登録/編集確認ページでPOST
Route::post('/manage_member_confirm', 'ManagementController@postmember_confirm')->name("manage_member_confirm.post");

//会員詳細ページを表示
Route::get('/manage_member_detail/{id}', 'ManagementController@getmember_detail')->name("manage_member_detail.show");

//会員詳細ページでPOST
Route::post('/manage_member_detail', 'ManagementController@postmember_detail')->name("manage_member_detail.post");



//商品カテゴリ一覧ページを表示
Route::get('/product_cate_list', 'ManagementController@getproduct_cate_list')->name("product_cate_list.show");

//商品カテゴリ登録ページを表示
Route::get('/product_cate_register', 'ManagementController@getproduct_cate_register')->name("product_cate_register.show");

//商品カテゴリ登録ページでPOST
Route::post('/product_cate_register', 'ManagementController@postproduct_cate_register')->name("product_cate_register.post");

//商品カテゴリ編集ページを表示
Route::get('/product_cate_edit/{id}', 'ManagementController@getproduct_cate_edit')->name("product_cate_edit.show");

//商品カテゴリ編集ページでPOST
Route::post('/product_cate_edit', 'ManagementController@postproduct_cate_edit')->name("product_cate_edit.post");

//商品カテゴリ確認ページを表示
Route::get('/product_cate_confirm', 'ManagementController@getproduct_cate_confirm')->name("product_cate_confirm.show");

//商品カテゴリ確認ページでPOST
Route::post('/product_cate_confirm', 'ManagementController@postproduct_cate_confirm')->name("product_cate_confirm.post");

//商品カテゴリ詳細ページを表示
Route::get('/product_cate_detail/{id}', 'ManagementController@getproduct_cate_detail')->name("product_cate_detail.show");

//商品カテゴリ詳細ページでPOST
Route::post('/product_cate_detail', 'ManagementController@postproduct_cate_detail')->name("product_cate_detail.post");


//商品一覧ページを表示
Route::get('/product_list', 'ManagementController@getproduct_list')->name("product_list.show");

//商品登録ページを表示
Route::get('/product_register', 'ManagementController@getproduct_register')->name("product_register.show");

//商品登録ページでPOST
Route::post('/product_register', 'ManagementController@postproduct_register')->name("product_register.post");

//商品編集ページを表示
Route::get('/product_edit/{id}', 'ManagementController@getproduct_edit')->name("product_edit.show");

//商品編集ページでPOST
Route::post('/product_edit', 'ManagementController@postproduct_edit')->name("product_edit.post");

//商品確認ページを表示
Route::get('/product_confirm', 'ManagementController@getproduct_confirm')->name("product_confirm.show");

//商品確認ページでPOST
Route::post('/product_confirm', 'ManagementController@postproduct_confirm')->name("product_confirm.post");

//商品詳細ページを表示
Route::get('/product_detail/{id}', 'ManagementController@getproduct_detail')->name("product_detail.show");

//商品詳細ページでPOST
Route::post('/product_detail', 'ManagementController@postproduct_detail')->name("product_detail.post");


//商品レビュー一覧ページを表示
Route::get('/review_list', 'ManagementController@getreview_list')->name("review_list.show");

//商品レビュー登録ページを表示
Route::get('/reviews_register', 'ManagementController@getreview_register')->name("reviews_register.show");

//商品レビュー登録ページでPOST
Route::post('/reviews_register', 'ManagementController@postreview_register')->name("reviews_register.post");

//商品レビュー編集ページを表示
Route::get('/reviews_edit/{id}', 'ManagementController@getreview_edit')->name("reviews_edit.show");

//商品レビュー編集ページでPOST
Route::post('/reviews_edit/{id}', 'ManagementController@postreview_edit')->name("reviews_edit.post");

//商品レビュー確認ページを表示
Route::get('/reviews_confirm', 'ManagementController@getreview_confirm')->name("reviews_confirm.show");

//商品レビュー確認ページでPOST
Route::post('/reviews_confirm', 'ManagementController@postreview_confirm')->name("reviews_confirm.post");

/*
|--------------------------------------------------------------------------
| ログイン認証
|--------------------------------------------------------------------------
*/
Auth::routes(['verify' => true]);
//ログインページへ遷移
Route::get('/login', 'member_loginController@getlogin')->name("login");//->middleware('auth:members');
//ログインページでPOSTされたとき
Route::post('/login', 'member_loginController@postlogin')->name("login.post");
Route::post('/resetpw_send', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name("resetpw_send.post");

//TOPページへ遷移
Route::get('/top', 'member_loginController@gettop')->name("top.show");




?>
