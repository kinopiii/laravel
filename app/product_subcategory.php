<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product_subcategory extends Model
{
    use SoftDeletes;

    protected $table = 'product_subcategorys';
    protected $fillable = ['id', 'product_category_id', 'name'];

    public static function get_subcategory() 
    {
        $all_subcategory = product_subcategory::all()->sortby('id');
        $ret_subcategory = array("," => "");
        foreach($all_subcategory as $subcategory){
             $ret_subcategory += [$subcategory->id .','. $subcategory->product_category_id => $subcategory->name];           
        }
        return $ret_subcategory;    
    }  
    public static function get_subcategory2() 
    {
        $all_subcategory = product_subcategory::all()->sortby('id');
        $ret_subcategory = array("" => "");
        foreach($all_subcategory as $subcategory){
             $ret_subcategory += array($subcategory->id => $subcategory->name);
        }
        return $ret_subcategory;    
    }

}
