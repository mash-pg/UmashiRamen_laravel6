<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Shop extends Authenticatable
{
    use Notifiable;
    protected $table = 'shop_tb';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id' ,
        'password',
        'email',
        'area_id',
        'shop_name',
        'shop_tel',
        'shop_address',
        'seat',
        'show_data',
        'dlflag',
        'avarage_price',
        'comments',
        'img',
        'img1',
        'img2'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
