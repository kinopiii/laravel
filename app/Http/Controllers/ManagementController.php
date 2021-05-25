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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
            
            $items = $query->groupby('product_categorys.name')->sortable()->orderBy('id', 'desc')->paginate(10);         
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


    //商品一覧ページ
    public function getproduct_list(Request $request){
        if($request->has('search')){
            $id = $request->get('id');
            $free = $request->get('free');

            $query = product::select();


            if(!empty($id)){
                $query->where('id',$id);
            }
            if(!empty($free)){
                $query->where('name',$free);
                $query->orwhere('product_content',$free);
            }
            
            $items = $query->sortable()->orderBy('id', 'desc')->paginate(10);         
        }

        //セッションのデータを削除
        session()->forget('form_input_edit');
        session()->forget('form_input_regist');
        session()->forget('id');
        session()->forget('read_temp_path1');
        session()->forget('read_temp_path2');
        session()->forget('read_temp_path3');
        session()->forget('read_temp_path4');

        return view('management.product_list',compact('items'));
    }


    //商品登録
    private $formItem = ['name', 'category', 'subcategory', 'product_content'];
    public function getproduct_register(Request $request){
        $input = session()->get('form_input_regist');
        $category = product_category::get_category();
        $subcategory = product_subcategory::get_subcategory();

        if($request->session()->exists('read_temp_path1')){
            $read_temp_path1 = $request->session()->get('read_temp_path1');
        }
        if($request->session()->exists('read_temp_path2')){
            $read_temp_path2 = $request->session()->get('read_temp_path2');
        }
        if($request->session()->exists('read_temp_path3')){
            $read_temp_path3 = $request->session()->get('read_temp_path3');
        }
        if($request->session()->exists('read_temp_path4')){
            $read_temp_path4 = $request->session()->get('read_temp_path4');
        }

        return view('management.product_register',compact('input', 'name', 'category','subcategory', 'product_content','read_temp_path1','read_temp_path2','read_temp_path3','read_temp_path4'));
    }

    //商品登録でPOST
    public function postproduct_register(Request $request){
        $input = $request->only($this->formItem);
        $this->validate($request, [
            'file' => 'file|image|mimes:jpg,jpeg,png,gif|max:10240'
        ]);

        if(\File::exists($request->file('image_1'))){
            $imagefile1 = $request->file('image_1');
            $temp_path1 = $imagefile1->store('public/temp');
            $read_temp_path1 = str_replace('public/', 'storage/', $temp_path1);
            $request->session()->put('read_temp_path1', $read_temp_path1);
        }
        if(\File::exists($request->file('image_2'))){
            $imagefile2 = $request->file('image_2');
            $temp_path2 = $imagefile2->store('public/temp');
            $read_temp_path2 = str_replace('public/', 'storage/', $temp_path2);
            $request->session()->put('read_temp_path2', $read_temp_path2);
        }
        if(\File::exists($request->file('image_3'))){
            $imagefile3 = $request->file('image_3');
            $temp_path3 = $imagefile3->store('public/temp');
            $read_temp_path3 = str_replace('public/', 'storage/', $temp_path3);
            $request->session()->put('read_temp_path3', $read_temp_path3);
        }        
        if(\File::exists($request->file('image_4'))){
            $imagefile4 = $request->file('image_4');
            $temp_path4 = $imagefile4->store('public/temp');
            $read_temp_path4 = str_replace('public/', 'storage/', $temp_path4);
            $request->session()->put('read_temp_path4', $read_temp_path4);
        }   

        $rules = [
            'name' => 'required|max:100',
            'category' => 'required|numeric|min:1',
            'subcategory' => 'required|numeric|min:1',
            'product_content' => 'required|max:500',
        ];
    
        $messages = [
            'name.required' => '※商品名は必須入力です。',
            'name.max'  => '※商品名は100字以内で入力してください',
            'category.required' => '※カテゴリは必須入力です。',
            'category.numeric' => '※カテゴリはリストから選択してください。',
            'category.min' => '※カテゴリはリストから選択してください。',
            'subcategory.required' => '※サブカテゴリは必須入力です。',
            'subcategory.numeric' => '※サブカテゴリはリストから選択してください。',
            'subcategory.min' => '※サブカテゴリはリストから選択してください。',
            'image_1.image'  => '※画像ファイルを選択してください',
            'image_1.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_1.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'image_2.image'  => '※画像ファイルを選択してください',
            'image_2.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_2.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'image_3.image'  => '※画像ファイルを選択してください',
            'image_3.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_3.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'image_4.image'  => '※画像ファイルを選択してください',
            'image_4.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_4.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'product_content.required' => '※商品説明は必須入力です。',
            'product_content.max'  => '※商品説明は500字以内で入力してください',
        ];
        
        session(['form_input_regist' => $input ]); 

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('ManagementController@getproduct_register')
                ->withErrors($validator)
                ->withInput();
        }
   
        return redirect()->action('ManagementController@getproduct_confirm');
    }     

    //商品編集
    public function getproduct_edit($id){
        $category = product_category::get_category();
        $subcategory = product_subcategory::get_subcategory();
        $input = session()->get('form_input_edit');

        session()->put('id', $id);

        $query = product::where('products.id', $id);
        $query->select('products.id as id','products.name as name','products.product_content as content','product_categorys.id as category_id','product_subcategorys.id as subcategory_id','products.image_1 as file1','products.image_2 as file2','products.image_3 as file3','products.image_4 as file4');
        $query->join('product_categorys', 'product_categorys.id','=','products.product_category_id');
        $query->join('product_subcategorys', 'product_subcategorys.id','=','products.product_subcategory_id');
        $items = $query->first();
        session(['items' => $items ]); 

        return view('management.product_edit',compact('items','id','category','subcategory','input'));
    }    

    //商品編集でPOST
    public function postproduct_edit(Request $request){
        $input = $request->only($this->formItem);
        $this->validate($request, [
            'file' => 'file|image|mimes:jpg,jpeg,png,gif|max:10240'
        ]);

        if(\File::exists($request->file('image_1'))){
            $imagefile1 = $request->file('image_1');
            $temp_path1 = $imagefile1->store('public/temp');
            $read_temp_path1 = str_replace('public/', 'storage/', $temp_path1);
            $request->session()->put('read_temp_path1', $read_temp_path1);
        }
        if(\File::exists($request->file('image_2'))){
            $imagefile2 = $request->file('image_2');
            $temp_path2 = $imagefile2->store('public/temp');
            $read_temp_path2 = str_replace('public/', 'storage/', $temp_path2);
            $request->session()->put('read_temp_path2', $read_temp_path2);
        }
        if(\File::exists($request->file('image_3'))){
            $imagefile3 = $request->file('image_3');
            $temp_path3 = $imagefile3->store('public/temp');
            $read_temp_path3 = str_replace('public/', 'storage/', $temp_path3);
            $request->session()->put('read_temp_path3', $read_temp_path3);
        }        
        if(\File::exists($request->file('image_4'))){
            $imagefile4 = $request->file('image_4');
            $temp_path4 = $imagefile4->store('public/temp');
            $read_temp_path4 = str_replace('public/', 'storage/', $temp_path4);
            $request->session()->put('read_temp_path4', $read_temp_path4);
        }   

        $rules = [
            'name' => 'required|max:100',
            'category' => 'required|numeric|min:1',
            'subcategory' => 'required|numeric|min:1',
            'product_content' => 'required|max:500',
        ];
    
        $messages = [
            'name.required' => '※商品名は必須入力です。',
            'name.max'  => '※商品名は100字以内で入力してください',
            'category.required' => '※カテゴリは必須入力です。',
            'category.numeric' => '※カテゴリはリストから選択してください。',
            'category.min' => '※カテゴリはリストから選択してください。',
            'subcategory.required' => '※サブカテゴリは必須入力です。',
            'subcategory.numeric' => '※サブカテゴリはリストから選択してください。',
            'subcategory.min' => '※サブカテゴリはリストから選択してください。',
            'image_1.image'  => '※画像ファイルを選択してください',
            'image_1.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_1.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'image_2.image'  => '※画像ファイルを選択してください',
            'image_2.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_2.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'image_3.image'  => '※画像ファイルを選択してください',
            'image_3.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_3.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'image_4.image'  => '※画像ファイルを選択してください',
            'image_4.mimes'  => '※拡張子が「jpg｣「jpeg｣「png｣「gif｣のものを選択してください',
            'image_4.max'  => '※ファイルサイズは10MB以下のものを選択してください',
            'product_content.required' => '※商品説明は必須入力です。',
            'product_content.max'  => '※商品説明は500字以内で入力してください',
        ];
        $request->session()->put('form_input_edit', $input);
    
        $id = session('id');
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('ManagementController@getproduct_edit',['id'=>$id])
                ->withErrors($validator)
                ->withInput();
        }
        session(['form_input_edit' => $input ]); 
        return redirect()->action('ManagementController@getproduct_confirm');
    }       

    //商品登録・編集確認画面
    public function getproduct_confirm(Request $request){
        if( url()->previous() === url("/product_register")){
            //商品登録の場合
            $input = session('form_input_regist');
            $read_temp_path1 = $request->session()->get('read_temp_path1');
            $read_temp_path2 = $request->session()->get('read_temp_path2');
            $read_temp_path3 = $request->session()->get('read_temp_path3');
            $read_temp_path4 = $request->session()->get('read_temp_path4');
        }else{
            //商品編集の場合
            $input = session('form_input_edit');
            $items = session('items'); 
            $read_temp_path1 = $request->session()->get('read_temp_path1');
            $read_temp_path2 = $request->session()->get('read_temp_path2');
            $read_temp_path3 = $request->session()->get('read_temp_path3');
            $read_temp_path4 = $request->session()->get('read_temp_path4');
            $id = session('id');
        }
        $category = product_category::get_category();
        $subcategory = product_subcategory::get_subcategory2();

        return view('management.product_confirm',compact('items','input','id','category','subcategory','read_temp_path1','read_temp_path2','read_temp_path3','read_temp_path4'));
    }  

    

    //商品登録・編集確認画面でPOST
    public function postproduct_confirm(Request $request){

        if(session()->has('id')){
            //商品編集の場合
            $id = session('id'); 
            $input = session('form_input_edit'); 
            $read_temp_path1 = $request->session()->get('read_temp_path1');
            $read_temp_path2 = $request->session()->get('read_temp_path2');
            $read_temp_path3 = $request->session()->get('read_temp_path3');
            $read_temp_path4 = $request->session()->get('read_temp_path4');   
            
            //商品のUPDATE
            $products = product::where('id',$id)->first();

        }else{
            //商品登録の場合
            $input = session('form_input_regist');
            $read_temp_path1 = $request->session()->get('read_temp_path1');
            $read_temp_path2 = $request->session()->get('read_temp_path2');
            $read_temp_path3 = $request->session()->get('read_temp_path3');
            $read_temp_path4 = $request->session()->get('read_temp_path4');
 
            $products = new \App\product;
        } 

            $products->product_category_id = $input['category'];
            $products->product_subcategory_id = $input['subcategory'];
            $products->name = $input['name'];
            $products->product_content = $input['product_content'];
 
    
            if(isset($read_temp_path1)){
                $temp_path1 = str_replace('storage/', 'public/', $read_temp_path1);
                $filename1 = str_replace('public/temp/', '', $temp_path1);
                $storage_path1 = 'public/products/'.$filename1;
                Storage::move($temp_path1, $storage_path1);
                $read_path1 = str_replace('public/', 'storage/', $storage_path1);
                $products->image_1 = $read_path1;
            }
            if(isset($read_temp_path2)){
                $temp_path2 = str_replace('storage/', 'public/', $read_temp_path2);
                $filename2 = str_replace('public/temp/', '', $temp_path2);
                $storage_path2 = 'public/products/'.$filename2;
                Storage::move($temp_path2, $storage_path2);
                $read_path2 = str_replace('public/', 'storage/', $storage_path2);
                $products->image_2 = $read_path2;
            }
            if(isset($read_temp_path3)){
                $temp_path3 = str_replace('storage/', 'public/', $read_temp_path3);
                $filename3 = str_replace('public/temp/', '', $temp_path3);
                $storage_path3 = 'public/products/'.$filename3;
                Storage::move($temp_path3, $storage_path3);
                $read_path3 = str_replace('public/', 'storage/', $storage_path3);
                $products->image_3 = $read_path3;
            }
            if(isset($read_temp_path4)){
                $temp_path4 = str_replace('storage/', 'public/', $read_temp_path4);
                $filename4 = str_replace('public/temp/', '', $temp_path4);
                $storage_path4 = 'public/products/'.$filename4;
                Storage::move($temp_path4, $storage_path4);
                $read_path4 = str_replace('public/', 'storage/', $storage_path4);
                $products->image_4 = $read_path4;
            }
    

            $products->save();




        //セッションのデータを削除
        session()->forget('form_input_edit');
        session()->forget('form_input_regist');
        session()->forget('id');
        session()->forget('read_temp_path1');
        session()->forget('read_temp_path2');
        session()->forget('read_temp_path3');
        session()->forget('read_temp_path4');

        return redirect()->action('ManagementController@getproduct_list');
    }
    
}
