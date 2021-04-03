<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Ranking extends Authenticatable
{
    use Notifiable;
    protected $table = 'ranking_tb';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_id' ,
        'okini_id',
        'reserve_count',
        'okini_count'
    ];
}
