<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\product_category;
use App\product_subcategory;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class products_registerController extends Controller
{

    private $formItems = ['name', 'category', 'subcategory', 'product_content'];

    //商品登録ページ
    public function getproduct_register(Request $request){
        if (Auth::check()){
        $input = $request->session()->get('form_input');
        $category = product_category::get_category();
        $subcategory = product_subcategory::get_subcategory();
    
        $request->session()->forget("returntop");
        $request->session()->forget("returnlist");

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
        
        return view('product_register.product_register')->with(compact('input', 'name', 'category','subcategory', 'product_content','read_temp_path1','read_temp_path2','read_temp_path3','read_temp_path4')); 
    }else {
            return redirect()->action('member_loginController@gettop');
        }
    }


    
    //フォームから確認画面へ
    public function postproducts(Request $request){
        $input = $request->only($this->formItems);
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
            'category' => 'required|numeric|between:1,5',
            'subcategory' => 'required|numeric|between:1,25',
            'product_content' => 'required|max:500',
        ];
    
        $messages = [
            'name.required' => '※商品名は必須入力です。',
            'name.max'  => '※商品名は100字以内で入力してください',
            'category.required' => '※カテゴリは必須入力です。',
            'category.numeric' => '※カテゴリはリストから選択してください。',
            'category.between' => '※カテゴリはリストから選択してください。',
            'subcategory.required' => '※サブカテゴリは必須入力です。',
            'subcategory.numeric' => '※サブカテゴリはリストから選択してください。',
            'subcategory.between' => '※サブカテゴリはリストから選択してください。',
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
        $request->session()->put('form_input', $input);

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->action('products_registerController@getproduct_register')
                ->withErrors($validator)
                ->withInput();
        }
   
        return redirect()->action('products_registerController@getproduct_confirm');
    }

    //商品登録確認ページ
    public function getproduct_confirm(Request $request){
        //sessionから取り出す
        $input = $request->session()->get('form_input');

        $read_temp_path1 = $request->session()->get('read_temp_path1');
        $read_temp_path2 = $request->session()->get('read_temp_path2');
        $read_temp_path3 = $request->session()->get('read_temp_path3');
        $read_temp_path4 = $request->session()->get('read_temp_path4');
        
        //カテゴリ、サブカテゴリを名前で表示
        $category = product_category::get_category();
        $subcategory = product_subcategory::get_subcategory2();

        return view('product_register.product_confirm',compact(
            "input",
            "category",
            "subcategory",
            "read_temp_path1",
            "read_temp_path2",
            "read_temp_path3",
            "read_temp_path4")
        );
    }

    //商品登録
    public function postproduct_confirm(Request $request){
        $input = $request->session()->get('form_input');
        $read_temp_path1 = $request->session()->get('read_temp_path1');
        $read_temp_path2 = $request->session()->get('read_temp_path2');
        $read_temp_path3 = $request->session()->get('read_temp_path3');
        $read_temp_path4 = $request->session()->get('read_temp_path4');

        //前に戻るボタンが押されたら$inputデータを保持して登録画面へ
        if($request->has('back')){
            return redirect()->action('products_registerController@getproduct_register')
            ->withInput($input);
        }          


        $products = new \App\product;
        $products->member_id = Auth::id();
        $products->product_category_id = $input['category'];
        $products->product_subcategory_id = $input['subcategory'];
        $products->name = $input['name'];


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

        $products->product_content = $input['product_content'];
        $products->save();

        //セッションのデータを削除
        $request->session()->forget("form_input");
        $request->session()->forget('read_temp_path1');
        $request->session()->forget('read_temp_path2');
        $request->session()->forget('read_temp_path3');
        $request->session()->forget('read_temp_path4');
        
        return redirect()->action('member_loginController@gettop');
    }

    //商品登録一覧ページ
    public function getproduct_list(Request $request){
        $category = product_category::get_category();
        $subcategory = product_subcategory::get_subcategory();
 
        if($request->has('search')){
            $category_id = $request->get('category');
            $subcategory_id = $request->get('subcategory');
            $free = $request->get('free');
    
            //カテゴリテーブルから取得
            $query = product::select();
            $query->select('products.name as product_name','product_categorys.name as category_name','product_subcategorys.name as subcategory_name','products.image_1 as file');
            $query->join('product_categorys', 'products.product_category_id','=','product_categorys.id');
            $query->join('product_subcategorys', 'products.product_subcategory_id','=','product_subcategorys.id');
            if(!empty($category_id)){
                $query->where('products.product_category_id',$category_id);
            }
            if(!empty($subcategory_id)){
                $query->where('products.product_subcategory_id',$subcategory_id);
            }
            if(!empty($free)){
                $query->where('products.name',$free);
                $query->orwhere('products.product_content',$free);
            }
            
            $items = $query->orderBy('products.id', 'desc')->paginate(10);
        }

        

        return view('product_register.product_list')->with(compact('category','subcategory','items'));
    }    

}
