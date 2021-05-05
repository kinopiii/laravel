<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\user;
use App\Member;
use Carbon\Carbon;
use App\Mail\SendAuthCode;
use Mail;

class mypageController extends Controller
{
    //マイページに遷移
    public function getmypage(){
        if (Auth::check()){
            $id = Auth::id();
            $query = Member::where('id', $id);
            $items = $query->first();
    
            return view('mypage.mypage', compact('items'));
        }else {
            return redirect()->action('member_loginController@gettop');
        }
    }

    //マイページでPOSTされたときの動作
    public function postmypage(Request $request){
        if($request->has('withdrawal')){
            return redirect()->action('mypageController@getwithdrawal');
        }elseif($request->has('changeinfo')){
            return redirect()->action('mypageController@getchangeinfo');
        }elseif($request->has('changepass')){
            return redirect()->action('mypageController@getchangepass');
        }elseif($request->has('changemail')){
            return redirect()->action('mypageController@getchangemail');
        }
        
    }  
    
    //退会ページ
    public function getwithdrawal(){
        if (Auth::check()){
            return view('mypage.withdrawal');
        }else {
            return redirect()->action('member_loginController@gettop');
        }
    }       

    //退会ページで「退会する｣が押されたとき
    public function postwithdrawal(){
        $id = Auth::id();
        $query = \App\Member::where('id',$id)->first();
        $query->deleted_at = Carbon::now();
        $query->save();
        return redirect()->action('member_loginController@gettop');
    }  

    //会員情報変更ページ
    public function getchangeinfo(){
        $id = Auth::id();
        $query = Member::where('id', $id);
        $items = $query->first();
        return view('mypage.changeinfo', compact('items'));
    }   

    //会員情報変更ページでPOST
    private $formItems = ['name_sei', 'name_mei', 'nickname', 'gender'];
    public function postchangeinfo(Request $request){
        $input = $request->only($this->formItems);
        
        $rules = [
            'name_sei' => 'required|max:20',
            'name_mei' => 'required|max:20',
            'nickname' => 'required|max:10',
            'gender' => 'required|between:1,2',
        ];
        $messages = [
            'name_sei.required' => '※氏名（姓）は必須入力です。',
            'name_sei.max'  => '※氏名（姓）は20字以内で入力してください',
            'name_mei.required' => '※氏名（名）は必須入力です。',
            'name_mei.max'  => '※氏名（名）は20文字以内で入力してください',
            'nickname.required' => '※ニックネームは必須入力です。',
            'nickname.max'  => '※ニックネームは10字以内で入力してください',
            'gender.required' => '※性別は必須入力です。',
            'gender.between' => '※性別は選択肢の中から選んでください。',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('mypageController@getchangeinfo')
                ->withErrors($validator)
                ->withInput();
        }
        $request->session()->put('form_input', $input);
        return redirect()->action('mypageController@getconfirminfo');

    }   
    //会員情報変更確認画面
    public function getconfirminfo(Request $request){
        //sessionから取り出す
        $input = $request->session()->get('form_input');
        return view('mypage.confirminfo',["input"=> $input]);
    } 


    //会員情報変更確認画面でPOST
    public function postconfirminfo(Request $request){
        $input = $request->session()->get('form_input');

        if($request->has('return')){
            return redirect()->action('mypageController@getchangeinfo')->withInput($input);
        }else{
            $id = Auth::id();
            $query = \App\Member::where('id',$id)->first();
    
            $query->name_sei = $input['name_sei'];
            $query->name_mei = $input['name_mei'];
            $query->nickname = $input['nickname'];
            $query->gender = $input['gender'];
            $query->save();
    
            $request->session()->forget("form_input");
    
            return redirect()->action('mypageController@getmypage');
        }
                 
    }     

    //パスワード変更ページ
    public function getchangepass(){
        return view('mypage.changepass');
    }

    //パスワード変更ページでPOSTされた
    public function postchangepass(Request $request){
        $input = $request->only(['password','password_confirmation']);

        $rules = [
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
            'password_confirmation' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20|same:password',
        ];
    
        $messages = [
            'password.required'  => '※パスワードは必須入力です。',
            'password.regex'  => '※パスワードは半角英数字で入力してください。',
            'password.min'  => '※パスワードは8文字以上20文字以下で入力してください。',
            'password.max'  => '※パスワードは8文字以上20文字以下で入力してください。',
            'password_confirmation.same'  => '※パスワードで入力したものと異なります。',
            'password_confirmation.regex'  => '※パスワード確認は半角英数字で入力してください。',
            'password_confirmation.required'  => '※パスワード確認は必須入力です。',
            'password_confirmation.min'  => '※パスワード確認は8文字以上20文字以下で入力してください。',
            'password_confirmation.max'  => '※パスワード確認は8文字以上20文字以下で入力してください。',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('mypageController@getchangepass')
                ->withErrors($validator)
                ->withInput();
        }

        $id = Auth::id();
        $query = \App\Member::where('id',$id)->first();
        $query->password = Hash::make($input['password']);
        $query->save();
        return redirect()->action('mypageController@getmypage');
    }

    //メールアドレス変更フォームの表示
    public function getchangemail(){
        $id = Auth::id();
        $query = Member::where('id', $id);
        $items = $query->first();
        return view('mypage.changemail', compact('items'));
    }

    //メールアドレス変更フォームでPOST
    public function postchangemail(Request $request){
        $input = $request->only(['email']);

        $rules = [
            'email' => 'required|email|max:200|unique:members,email'
        ];

        $messages = [
            'email.required'  => '※メールアドレスは必須入力です。',
            'email.email'  => '※メールアドレスは正しい形式で入力してください。',
            'email.unique'  => '※メールアドレスは既に存在します。',
            'email.max'  => '※メールアドレスは200文字以内で入力してください。',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('mypageController@getchangemail')
                ->withErrors($validator)
                ->withInput();
        }

        $random_password = '';
        for($i = 0 ; $i < 6 ; $i++) {
            $random_password .= strval(rand(0, 9));
        }
        $id = Auth::id();
        $query = \App\Member::where('id',$id)->first();
        $query->auth_code = $random_password; 
        $query->save();

        Mail::to($input)->send(new SendAuthCode($random_password));
        

        session(['inputemail' => $input['email'] ]);

        return redirect()->action('mypageController@getcompletemail', compact('id','email'));
    }    




    //メールアドレス変更認証完了ページを表示
    public function getcompletemail(){

        return view('mypage.completemail');
    }

    
    //メールアドレス変更認証完了ページでPOST
    public function postcompletemail(Request $request){
        $email = session('inputemail');
        $auth_code = $request->input('auth_code');

        $id = Auth::id();
        $query = \App\Member::where('id',$id)->first();
        if($query->auth_code == $auth_code){
            $query->email = $email;
            $query->save();
            return redirect()->action('mypageController@getmypage');
            session()->forget('inputemail');
        }else{
            $error ='※認証コードが違います';
            return view('mypage.completemail', compact('error'));
        }
        
    }    
        
        
}
?>