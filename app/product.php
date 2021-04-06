<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id', 'member_id', 'product_category_id', 'product_subcategory_id', 'name', 'product_content'];
}
