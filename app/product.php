<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable; 

class product extends Model
{
    use Sortable; 
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['id', 'member_id', 'product_category_id', 'product_subcategory_id', 'name', 'product_content'];
}
