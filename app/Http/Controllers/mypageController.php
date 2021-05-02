<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\user;
use App\Member;
use Carbon\Carbon;

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
    public function postmypage(){
        return redirect()->action('mypageController@getwithdrawal');
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

}
?>