<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table = 'members';
    protected $fillable = ['name_sei', 'name_mei', 'nickname', 'gender', 'password', 'email'];
}
