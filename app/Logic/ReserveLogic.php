<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reserve;


class ReserveLogic extends Model
{
    //お店予約DB処理
    //予約取得
    public function reserve(){
        $reserves = Reserve::all();
        return $reserves;
    }

    //予約存在確認とカウント処理
    public function reserveExists($timerp,$shop_id,$auth){
        
        $rsexists = Reserve::where('reserve_time', $timerp)
                    ->where('shop_id', $shop_id)
                    ->where('dlflag','1')
                    ->where('user_id',$auth)
                    ->exists();
        $rscount  = Reserve::where('shop_id', $shop_id)
                    ->where('dlflag','1')
                    ->count();
        return [$rsexists,$rscount];
    }
    //お店予約処理
    public function reserveShop($shop_id,$auth,$number,$timerp){
        $reserve = Reserve::create([
            'shop_id' => $shop_id,
            'user_id' => $auth,
            'number' => $number,
            'reserve_time' => $timerp,
            'dlflag' => 1,
            'reserve_count' => 1
        ]);
        return $reserve;
    }
    //予約削除
    public function shopDelete($id){
        Reserve::where('id',$id)
                ->update(['dlflag'=>'3']);
    }
}
