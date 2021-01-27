<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\user;


class member_loginController extends Controller
{
    //トップページへ
    public function gettop(){
        return view('member_login.top');
    }


    //ログインフォームへ
    public function getlogin(){
        return view('member_login.login');
    }
    //ログインページでpostされたとき
    public function postlogin(Request $request){
        if($request->has('back')){
            return redirect()->action('member_loginController@gettop');
        }
        //ログインのボタンが押されたとき
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email,
        'password' => $password])) {
          $user = Auth::user();
          return view('member_login.top', ['user' => $user]);
        } else {
          $msg = "※IDもしくはパスワードが間違っています。";
          return view('member_login.login', ['message' => $msg]);
        }
    }

    //ログアウト
    public function logout(){
        Auth::logout();
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

    }


    //パスワード再設定（メール送信完了）ページへ
    public function getresetpw_sent(){
        return view('member_login.resetpw_sent');
    }
    //パスワード再設定（メール送信完了）
    public function postresetpw_sent(){
        return redirect()->action('member_loginController@gettop');
    }


    //パスワード再設定(パスワード設定) ページへ
    public function getresettingpw(){
        return view('member_login.resettingpw');
    }
    //パスワード再設定(パスワード設定) でpostされたとき
    public function postresettingpw(Request $request){
        if($request->has('back')){
            return redirect()->action('member_loginController@gettop');
        }
        //メール形式であることを確認
        $this->validate($request, ['email' => 'required|email'], $messages = ['email.required'  => '※メールアドレスは必須入力です。','email.email'  => '※メールアドレスは正しい形式で入力してください。']);
        //PWリセットのメール送信
        $email = $request->email;
        return $this->to('$email')  // 送信先アドレス
        ->subject('パスワード再発行')// 件名
        ->view('member_login.mail')// 本文
        ->with(['name' => $this->name]);// 本文に送る値

        //メール送信完了画面を表示
        return view('member_login.resetpw_sent');
    }


}


