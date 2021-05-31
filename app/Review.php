<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable; 

class Review extends Model
{
    protected $table = 'reviews';
    use SoftDeletes;
    use Sortable; 
}
