<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Management;
use App\Member;
use App\product;
use App\product_category;
use App\product_subcategory;
use Carbon\Carbon;

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
        session()->forget('id');
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
            
            $items = $query->sortable()->orderBy('id', 'desc')->paginate(10);         
        }
        return view('management.member_list',compact('items'));
    }

    //会員登録ページ
    public function getmember_register(){
        return view('management.member_register');
    }

    //会員登録ページでPOST
    private $formItems = ['name_sei', 'name_mei', 'nickname', 'gender', 'password', 'password_confirmation', 'email'];
    public function postmember_register(Request $request){
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
            return redirect()->action('ManagementController@getmember_register')
                ->withErrors($validator)
                ->withInput();
        }
        session(['form_input_regist' => $input ]); 
        return redirect()->action('ManagementController@getmember_confirm');
    }    

    //会員編集ページ
    public function getmember_edit($id){
        $query = Member::where('id', $id);
        $items = $query->first();
        session()->put('id', $id);
        return view('management.member_edit',compact('items'));
    }

    //会員編集ページでPOST
    public function postmember_edit(Request $request){
        $input = $request->only($this->formItems);
        $id = $request->session()->get('id');
        $dbpassword = Member::where('id', $id)->value('password');  
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');

        $dbemail = Member::where('id', $id)->value('email'); 
        $email = $request->get('email'); 

        $rules = [
            'name_sei' => 'required|max:20',
            'name_mei' => 'required|max:20',
            'nickname' => 'required|max:10',
            'gender' => 'required',
            'email' => 'required|email|max:200'
        ];
        if($dbemail != $email){
            $rules['email'] = 'unique:members,email';
        }
        if(empty($password) ){
            $rules['password'] = 'nullable';
        }elseif($dbpassword != $password){
            $rules['password'] = 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20';
        }
        if(empty($password_confirmation) ){
            $rules['password_confirmation'] = 'nullable';
        }elseif($dbpassword != $password_confirmation){
            $rules['password_confirmation'] = 'required|regex:/^[a-zA-Z0-9]+$/|min:8|max:20';
        }
     
    
        $messages = [
            'name_sei.required' => '※氏名（姓）は必須入力です。',
            'name_sei.max'  => '※氏名（姓）は20字以内で入力してください',
            'name_mei.required' => '※氏名（名）は必須入力です。',
            'name_mei.max'  => '※氏名（名）は20文字以内で入力してください',
            'nickname.required' => '※ニックネームは必須入力です。',
            'nickname.max'  => '※ニックネームは10字以内で入力してください',
            'gender.required' => '※性別は必須入力です。',
            'password.regex'  => '※パスワードは半角英数字で入力してください。',
            'password.min'  => '※パスワードは8文字以上20文字以下で入力してください。',
            'password.max'  => '※パスワードは8文字以上20文字以下で入力してください。',
            'password_confirmation.same'  => '※パスワードで入力したものと異なります。',
            'password_confirmation.regex'  => '※パスワードは半角英数字で入力してください。',
            'password_confirmation.min'  => '※パスワード確認は8文字以上20文字以下で入力してください。',
            'password_confirmation.max'  => '※パスワード確認は8文字以上20文字以下で入力してください。',
            'email.required'  => '※メールアドレスは必須入力です。',
            'email.email'  => '※メールアドレスは正しい形式で入力してください。',
            'email.unique'  => '※メールアドレスは既に存在します。',
            'email.max'  => '※メールアドレスは200文字以内で入力してください。',
        ];
    
        $validator = Validator::make($input, $rules, $messages);
        
        if($validator->fails()){
            return redirect()->route('manage_member_edit.show',['id'=>$id])
                ->withErrors($validator)
                ->withInput();
        }
        session(['form_input_edit' => $input ]); 

        return redirect()->action('ManagementController@getmember_confirm');
    }
    
    //会員登録・編集確認ページ
    public function getmember_confirm(){
        
        if( url()->previous() === url("/manage_member_register")){
            //会員登録の場合
            $input = session('form_input_regist');
        }else{
            //会員編集の場合
            $input = session('form_input_edit');
            $id = session('id');
        }
        
        return view('management.member_confirm',compact('input','id'));
        

        

    }

    //会員登録・編集確認ページでPOST
    public function postmember_confirm(Request $request){

        if(session()->has('id')){
            //会員編集の場合
            $id = session('id'); 
            $input = session('form_input_edit');           
            $members = Member::where('id',$id)->first();
            $members->name_sei = $input['name_sei'];
            $members->name_mei = $input['name_mei'];
            $members->nickname = $input['nickname'];
            $members->gender = $input['gender'];
            if(!empty($input['password'])){
                $members->password = $input['password'];
            }
            $members->email = $input['email'];
            $members->save();
            session()->forget('id');
        }else{
            //会員登録の場合
            $input = session('form_input_regist');
            $members = new Member;
            $members->name_sei = $input['name_sei'];
            $members->name_mei = $input['name_mei'];
            $members->nickname = $input['nickname'];
            $members->gender = $input['gender'];
            $members->password = $input['password'];
            $members->email = $input['email'];
            $members->save();
        }
        //セッションのデータを削除
        session()->forget('form_input_edit');
        session()->forget('form_input_regist');
        session()->forget('id');

        return redirect()->action('ManagementController@getmember_list');
    }

    //会員詳細ページ
    public function getmember_detail($id){
        $query = Member::where('id', $id);
        $items = $query->first();
        session()->put('id', $id);
        return view('management.member_detail',compact('items','id'));
    }

    //会員詳細でPOST
    public function postmember_detail(){
        $id = session('id'); 
        $query = Member::where('id', $id)->first();
        $query->deleted_at = Carbon::now();
        $query->save();
        return redirect()->action('ManagementController@getmember_list');
    }


    //商品カテゴリ一覧ページ
    public function getproduct_cate_list(Request $request){
        if($request->has('search')){
            $id = $request->get('id');
            $free = $request->get('free');

            $query = product_category::select();


            if(!empty($id)){
                $query->where('product_categorys.id',$id);
            }
            if(!empty($free)){
                $query->where('product_categorys.name',$free);
                $query->orwhere('product_subcategorys.name',$free);
            }

            $query->select('product_categorys.id as id','product_categorys.created_at as created_at','product_categorys.name as category');
            $query->join('product_subcategorys', 'product_categorys.id','=','product_subcategorys.product_category_id');
            
            $items = $query->groupby('product_categorys.name')->orderBy('id', 'desc')->paginate(10);         
        }
        return view('management.product_cate_list',compact('items'));
    }


    //商品カテゴリ登録
    public function getproduct_cate_register(){
        return view('management.product_cate_register');
    }

    //商品カテゴリ登録でPOST
    public function postproduct_cate_register(Request $request){
        $input = $request->all();
        $rules = [
            'category' => 'required|max:20',
            'subcategory1' => 'nullable|max:20',
            'subcategory2' => 'nullable|max:20',
            'subcategory3' => 'nullable|max:20',
            'subcategory4' => 'nullable|max:20',
            'subcategory5' => 'nullable|max:20',
            'subcategory6' => 'nullable|max:20',
            'subcategory7' => 'nullable|max:20',
            'subcategory8' => 'nullable|max:20',
            'subcategory9' => 'nullable|max:20',
            'subcategory10' => 'nullable|max:20',
            'subcategory_dummy' => 'required_without_all:subcategory1,subcategory2,subcategory3,subcategory4,subcategory5,subcategory6,subcategory7,subcategory8,subcategory9,subcategory10',
        ];
    
        $messages = [
            'category.required' => '※カテゴリは必須入力です。',
            'category.max'  => '※カテゴリは20字以内で入力してください',
            'subcategory1.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory2.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory3.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory4.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory5.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory6.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory7.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory8.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory9.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory10.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory_dummy.required_without_all'  => '※サブカテゴリは1つ以上入力してください',
        ];
    
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('ManagementController@getproduct_cate_register')
                ->withErrors($validator)
                ->withInput();
        }
        session(['form_input_regist' => $input ]); 
        return redirect()->action('ManagementController@getproduct_cate_confirm');
    }     

    //商品カテゴリ編集
    public function getproduct_cate_edit($id){
        $category = product_category::where('id', $id)->value('name');
        $items = product_subcategory::where('product_category_id', $id)->get();

        session()->put('id', $id);

        return view('management.product_cate_edit',compact('category','items','id'));
    }    

    //商品カテゴリ編集でPOST
    public function postproduct_cate_edit(Request $request){
        $input = $request->all();
        $rules = [
            'category' => 'required|max:20',
            'subcategory1' => 'nullable|max:20',
            'subcategory2' => 'nullable|max:20',
            'subcategory3' => 'nullable|max:20',
            'subcategory4' => 'nullable|max:20',
            'subcategory5' => 'nullable|max:20',
            'subcategory6' => 'nullable|max:20',
            'subcategory7' => 'nullable|max:20',
            'subcategory8' => 'nullable|max:20',
            'subcategory9' => 'nullable|max:20',
            'subcategory10' => 'nullable|max:20',
            'subcategory_dummy' => 'required_without_all:subcategory1,subcategory2,subcategory3,subcategory4,subcategory5,subcategory6,subcategory7,subcategory8,subcategory9,subcategory10',
        ];
    
        $messages = [
            'category.required' => '※カテゴリは必須入力です。',
            'category.max'  => '※カテゴリは20字以内で入力してください',
            'subcategory1.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory2.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory3.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory4.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory5.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory6.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory7.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory8.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory9.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory10.max'  => '※サブカテゴリは20字以内で入力してください',
            'subcategory_dummy.required_without_all'  => '※サブカテゴリは1つ以上入力してください',
        ];
    
        $id = session('id');
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('ManagementController@getproduct_cate_edit',['id'=>$id])
                ->withErrors($validator)
                ->withInput();
        }
        session(['form_input_edit' => $input ]); 
        return redirect()->action('ManagementController@getproduct_cate_confirm');
    }       

    //商品カテゴリ登録・編集確認画面
    public function getproduct_cate_confirm(Request $request){
        if( url()->previous() === url("/product_cate_register")){
            //会員登録の場合
            $input = session('form_input_regist');
        }else{
            //会員編集の場合
            $input = session('form_input_edit');
            $id = session('id');
        }
        
        return view('management.product_cate_confirm',compact('input','id'));
    }  

    

    //商品カテゴリ登録・編集確認画面でPOST
    public function postproduct_cate_confirm(Request $request){

        if(session()->has('id')){
            //商品カテゴリ編集の場合
            $id = session('id'); 
            $input = session('form_input_edit');    
            
            //カテゴリのUPDATE
            $product_category = product_category::where('id',$id)->first();
            $product_category->name = $input['category'];
            $product_category->save();

            //サブカテゴリのUPDATE（削除し、新規追加）
            $product_subcategory = product_subcategory::where('product_category_id',$id)->forcedelete();

            for($i = 1; $i <= 10; $i++){
                if(!empty($input['subcategory'.$i])){
                    $product_subcategory = new product_subcategory;
                    $product_subcategory->product_category_id = $id;
                    $product_subcategory->name = $input['subcategory'.$i];
                    $product_subcategory->save();
                }
            }
            session()->forget('id');
        }else{
            //商品カテゴリ登録の場合
            $input = session('form_input_regist');
            $product_category = new product_category;
            $product_category->name = $input['category'];
            $product_category->save();

            //登録したカテゴリＩＤを取得
            $category = $input['category'];
            $id = product_category::where('name', $category)->value('id');  

            //サブカテゴリに登録
            for($i = 1; $i <= 10; $i++){
                if(!empty($input['subcategory'.$i])){
                    $product_subcategory = new product_subcategory;
                    $product_subcategory->product_category_id = $id;
                    $product_subcategory->name = $input['subcategory'.$i];
                    $product_subcategory->save();
                }
            }

        }
        //セッションのデータを削除
        session()->forget('form_input_edit');
        session()->forget('form_input_regist');
        session()->forget('id');

        return redirect()->action('ManagementController@getproduct_cate_list');
    }

    //商品カテゴリ詳細ページ
    public function getproduct_cate_detail($id){
        $category = product_category::where('id', $id)->value('name');
        $items = product_subcategory::where('product_category_id',$id)->get();

        session()->put('id', $id);
        return view('management.product_cate_detail',compact('items','id','category'));
    }

    //商品カテゴリ詳細でPOST
    public function postproduct_cate_detail(){
        //大カテゴリから削除
        $id = session('id'); 
        $query = product_category::where('id', $id)->delete();


        //小カテゴリから削除
        $query = product_subcategory::where('product_category_id', $id)->delete();

        return redirect()->action('ManagementController@getproduct_cate_list');
    }    

}
