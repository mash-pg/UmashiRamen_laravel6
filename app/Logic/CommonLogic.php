<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reserve;
use App\Models\Okini;

class CommonLogic extends Model
{
    
    //カウント処理
    public function reserveCount($shop_id){
        
        $count_reserve = Reserve::where('shop_id', $shop_id)
        ->where('dlflag','1')      
        ->count();

        $count_okini = Okini::where('shop_id', $shop_id)
        ->where('dlflag','1')
        ->count();

        return [$count_reserve,$count_okini];
    }
}
