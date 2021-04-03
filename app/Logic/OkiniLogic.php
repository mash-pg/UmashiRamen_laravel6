<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use App\Models\Okini;

class OkiniLogic extends Model
{
    //お店予約DB処理
    //お気に入り取得
    public function okini($auth){
        $okini = Okini::where('user_id', $auth);
        return $okini;
    }
    
    //お気に入り存在確認
    public function okiniExists($auth,$shop_id){
        $okiniinfo = Okini::where('shop_id', $shop_id)
        ->where('user_id',$auth)
        ->where('dlflag','1')  
        ->exists();
        return $okiniinfo;
    }

    //お気に入り登録
    public function okiniShop($auth,$shop_id){
        $okinis = Okini::create([
            'shop_id' => $shop_id,
            'user_id' => $auth,
            'dlflag' => 1,
        ]);
        return $okinis;
    }

    //お気に入り削除
    public function okiniDelete($okini_id){
        Okini::where('id',$okini_id)
            ->update(['dlflag'=>'3']);
    }

}
