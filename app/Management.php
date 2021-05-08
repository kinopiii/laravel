<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Management extends Model
{
    protected $table = 'administers';
    use SoftDeletes;
}
