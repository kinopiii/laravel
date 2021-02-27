<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\user;

class member_loginController extends Controller
{
    //トップページに遷移
    public function gettop(){
        if (Auth::check()){
            $user = Auth::user();
            return view('member_login.top_login');
        } else {
            return view('member_login.top');
        }
    }

    //POSTでTOPに遷移
    public function posttop(){
        return view('member_login.top');
    }


    //ログインフォームへ
    public function getlogin(){
        return view('member_login.login');
    }

    //ログインページでpostされたとき
    public function postlogin(Request $request){
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email,
        'password' => $password])) {
          $user = Auth::user();
          //return view('member_login.top_login', ['user' => $user]);
          return redirect('/top');
        } else {
          $msg = "※IDもしくはパスワードが間違っています。";
          return back()//1つ前の入力画面に戻す
          ->withInput()//入力値を保持する
          ->with(['message' => '※IDもしくはパスワードが間違っています']);
        }
    }

    //ログアウト
    public function logout(){
        Auth::logout();
        //return view('member_login.top');
        return view('member_login.top');
    }


    //パスワード再設定（メール送信）ページへ
    public function getresetpw_send(){
        return view('member_login.resetpw_send');
    }
    //パスワード再設定（メール送信）ページでpostされたとき
    public function postresetpw_send(Request $request){
        if($request->has('back')){
            return redirect()->action('member_loginController@gettop');
        }
        //メール送信の動作をここに記入
	return redirect()->action('member_loginController@getresetpw_sent');
    }


    //パスワード再設定（メール送信完了）ページへ
    public function getresetpw_sent(){
        return view('member_login.resetpw_sent');
    }



}


