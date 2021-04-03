<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Reserve extends Authenticatable
{
    use Notifiable;
    protected $table = 'reserve_tb';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id' ,
        'shop_id',
        'user_id',
        'number',
        'reserve_time',
        'dlflag'
    ];
}
