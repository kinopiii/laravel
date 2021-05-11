<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Management;
use App\Member;

class ManagementController extends Controller
{
    //トップページに遷移
    public function gettop(Request $request){
        $member = $request->session()->get("admin_auth");
        if(!empty($member)){
            return view('management.top',compact('member'));
        }else{
            return redirect()->action('ManagementController@getlogin'); 
        }
        
    }

    //トップページでPOST
    public function posttop(Request $request){
        $request->session()->forget("admin_auth");
        return redirect()->action('ManagementController@getlogin');
    }


    //ログインフォームへ
    public function getlogin(){
        return view('management.login');
    }

    //ログインページでpostされたとき
    public function postlogin(Request $request){
        $input = $request->only(['login_id','password']);
        
        //バリデーション確認
        $rules = [
            'login_id' => 'required|regex:/^[a-zA-Z0-9]+$/|min:7|max:10',
            'password' => 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20',
        ];
    
        $messages = [
            'login_id.required'  => '※ログインIDは必須入力です。',
            'login_id.regex'  => '※ログインIDは半角英数字で入力してください。',
            'login_id.min'  => '※ログインIDは7文字以上10文字以下で入力してください。',
            'login_id.max'  => '※ログインIDは7文字以上10文字以下で入力してください。',
            'password.required'  => '※パスワードは必須入力です。',
            'password.regex'  => '※パスワードは半角英数字で入力してください。',
            'password.min'  => '※パスワードは8文字以上20文字以下で入力してください。',
            'password.max'  => '※パスワードは8文字以上20文字以下で入力してください。',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('ManagementController@getlogin')
                ->withErrors($validator)
                ->withInput();
        }
        //ログイン確認
		$login_id = $request->input("login_id");
		$password = $request->input("password");

        $query = Management::where('login_id', $login_id);
        $member = $query->first();

        //ログイン成功
        if($member['login_id'] == $login_id && $member['password'] == $password){
            $request->session()->put("admin_auth", $member );
			return redirect()->action('ManagementController@gettop');
        }else {
            //ログイン失敗
            return redirect()->action('ManagementController@getlogin')
            ->withInput()
            ->withErrors([
                "login" => "※ユーザーIDまたはパスワードが違います"
            ]);
        }
    }

    //会員一覧ページ
    public function getmember_list(Request $request){
        if($request->has('search')){
            $id = $request->get('id');
            $gender1 = $request->get('gender1');
            $gender2 = $request->get('gender2');
            $free = $request->get('free');

            $query = Member::select();
            if(!empty($id)){
                $query->where('id',$id);
            }
            if(!empty($gender1) && !empty($gender2)){
                $query->where('gender',$gender1);
                $query->orwhere('gender',$gender2);
            }elseif(!empty($gender1)){
                $query->where('gender',$gender1);
            }elseif(!empty($gender2)){
                $query->where('gender',$gender2);
            }
            if(!empty($free)){
                $query->where('name_sei',$free);
                $query->orwhere('name_mei',$free);
                $query->orwhere('email',$free);
            }
            
            $items = $query->sortable()->paginate(10);         
        }
        return view('management.member_list',compact('items'));
    }


    
}
