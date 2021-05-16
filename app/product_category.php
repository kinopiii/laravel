<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable; 

class product_category extends Model
{
    use SoftDeletes;
    use Sortable;

    protected $table = 'product_categorys';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public static function get_category() 
    {
        $all_category = product_category::all()->sortby('id');
        $ret_category = array("" => "");
        foreach($all_category as $category){
             $ret_category += array($category->id => $category->name);
        }
        return $ret_category;    
    }  

}
