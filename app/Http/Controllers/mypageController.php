<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\user;
use App\Member;

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

}
?>