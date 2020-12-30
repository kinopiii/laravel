<?php

namespace App\Http\Controllers;


use App\Http\Requests\member_registerRequest;
use Illuminate\Http\Request;
use Validator;
use App\Member;


class member_registerController extends Controller
{

//会員登録ページ
public function getmember_register(){
    return view('member_register.member_register');
}



//登録完了ページ
public function getregister_completed(){
    return view('member_register.register_completed');
}

private $formItems = ['name_sei', 'name_mei', 'nickname', 'gender', 'password', 'password_confirmation', 'email'];


//POSTされたときのValidationルール
public function post(Request $request){

    $input = $request->only($this->formItems);
    $rules = [
        'name_sei' => 'required|max:20',
        'name_mei' => 'required|max:20',
        'nickname' => 'required|max:10',
        'gender' => 'required',
        'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
        'password_confirmation' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|same:password',
        'email' => 'required|email|max:200|unique:members,email'
    ];

    $messages = [
        'name_sei.required' => '※氏名（姓）は必須入力です。',
        'name_sei.max'  => '※氏名（姓）は20字以内で入力してください',
        'name_mei.required' => '※氏名（名）は必須入力です。',
        'name_mei.max'  => '※氏名（名）は20文字以内で入力してください',
        'nickname.required' => '※ニックネームは必須入力です。',
        'nickname.max'  => '※ニックネームは10字以内で入力してください',
        'gender.required' => '※性別は必須入力です。',
        'password.required'  => '※パスワードは必須入力です。',
        'password.regex'  => '※パスワードは半角英数字で入力してください。',
        'password.min'  => '※パスワードは8文字以上20文字以下で入力してください。',
        'password.max'  => '※パスワードは8文字以上20文字以下で入力してください。',
        'password_confirmation.same'  => '※パスワードで入力したものと異なります。',
        'password_confirmation.regex'  => '※パスワードは半角英数字で入力してください。',
        'password_confirmation.required'  => '※パスワード確認は必須入力です。',
        'password_confirmation.min'  => '※パスワード確認は8文字以上20文字以下で入力してください。',
        'password_confirmation.max'  => '※パスワード確認は8文字以上20文字以下で入力してください。',
        'email.required'  => '※メールアドレスは必須入力です。',
        'email.email'  => '※メールアドレスは正しい形式で入力してください。',
        'email.unique'  => '※メールアドレスは既に存在します。',
        'email.max'  => '※メールアドレスは200文字以内で入力してください。',
    ];

    $validator = Validator::make($input, $rules, $messages);
    if($validator->fails()){
        return redirect()->action('member_registerController@getmember_register')
            ->withErrors($validator)
            ->withInput();
    }
    $request->session()->put('form_input', $input);
    return redirect()->action('member_registerController@confirm');
}


public function confirm(Request $request){
    //sessionから取り出す
    $input = $request->session()->get('form_input');
    //$inputにデータがなければ登録画面へ
    if(!$input){
        return redirect()->action('member_registerController@getmember_register')->withinput($input);
    }
    //$inputデータを保持して登録確認画面へ
    return view('member_register.register_confirm',["input"=> $input]);
}

//確認画面でボタン（戻るor登録）が押された時の処理
public function register(Request $request){
    //sessionから取り出す
    $input = $request->session()->get('form_input');
    //前に戻るボタンが押されたら$inputデータを保持して登録画面へ
    if($request->has('back')){
        return redirect()->action('member_registerController@getmember_register')
            ->withInput($input);
    }
    //もし$inputにデータがなければ登録画面へ
    if(!$input){
        return redirect()->action('member_registerController@getmember_register')->withinput($input);
    }
    //上記以外はDB登録を行い、登録完了画面へ(PWはhash化)
    $members = new \App\Member;
    $members->name_sei = $input['name_sei'];
    $members->name_mei = $input['name_mei'];
    $members->nickname = $input['nickname'];
    $members->gender = $input['gender'];
    $hashpass = bcrypt($input['password']);
    $members->password = $hashpass;
    $members->email = $input['email'];
    $members->save();

	//セッションを空にする
    $request->session()->forget("form_input");
    //登録完了ページへ
    return redirect()->action("member_registerController@getregister_completed");
}


}
