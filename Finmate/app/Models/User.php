<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Models
 * File Name    : User.php
 * History      : v001 0615 EY.Sin new
 *******************************************/

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Artisan;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'userno';
    protected $fillable = [
        'userid',
        'userpw',
        'username',
        'useremail',
        'phone',
        'moffintype',
        'moffinname',
        'point',
        'login_count',
        'point_draw_count',
        'item_draw_count',
        'history_check_count'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'userpw',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    protected $dates = ['deleted_at']; // softDeletes() 사용시 쓰는 것. 어떤 컬럼이 데이트 타입이다 지정 용도.
}
