<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmail;

class Member extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;
    use SoftDeletes;

    //
    protected $table = 'members';
    protected $fillable = ['name_sei', 'name_mei', 'nickname', 'gender', 'password', 'email'];
}
