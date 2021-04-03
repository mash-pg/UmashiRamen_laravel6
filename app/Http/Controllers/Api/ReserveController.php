<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Logic\ReserveLogic;
use App\Logic\CommonLogic;
use App\Logic\RankingLogic;

use App\Models\Shop;
use App\Models\Okini;
use App\Models\Reserve;
use App\Models\Category;
use App\Models\Ranking;

class ReserveController extends Controller
{
    // 予約処理
    public function shopReserveInsert(Request $request, 
                                      Reserve $reserve,
                                      ReserveLogic $reservelogic,
                                      RankingLogic $rankinglogic,
                                      CommonLogic $commonlogic){

        // $shofindex = new ShopIndexController();
        
        //ログイン情報(user_id)
        $auth = Auth::user()->user_id;
        $auth1 = auth()->id();
        $auth2 = auth('shop')->id();
        Log::info("test : ".$auth1);
        Log::info("test : ".$auth2);
        // Log::info("test : ".$auth);

        //変数定義
        $time = $request['reserve']['datetime'];
        $shop_id = $request['shop']['shop_id'];
        $number = $request['reserve']['number'];

        //jsから取得したDateからTを削除
        $timerp = str_replace("T"," ",$time);

        list($rsexists,$rscount) = $reservelogic->reserveExists($timerp,$shop_id,$auth);
        list($count_reserve,$count_okini) = $commonlogic->reserveCount($shop_id);

        if($rsexists){
            //存在しない場合リダイレクト
            return \redirect();
        }else {
            //ランキングテーブルにお店IDまたはお気に入りIDがあればupdate
            $rankinginfo = $rankinglogic->rankingExists($shop_id);
            if(!$rankinginfo){
                $ranking = $rankinglogic->rankingCountReserve($shop_id,$count_okini);
                      
            }else {
                $ranking = $rankinglogic->rankingReserveUpdate($shop_id, $rscount,$count_okini);
            }

            //ランキングテーブルに値がなければinsert
            $reserve = $reservelogic->reserveShop($shop_id,$auth,$number,$timerp);
            return response()->json(['reserve' => $reserve]);
        }

    }

    //ユーザー予約
    public function shopReserveShow(Shop $shop){
        $shofindex = new ShopIndexController();
        $auth = $shofindex->authInfo();
        if($auth === 1){
            return view("user/top");
        }
        $shops = Shop::all();
        return response()->json(['shop' => $shop]);
    }

    //予約取消
    public function shopReserveDeleteShow(Reserve $reserve,
                                          RankingLogic $rankinglogic,
                                          ReserveLogic $reservelogic){
        //変数定義
        $id = $reserve['id'];
        $shop_id = $reserve['shop_id'];
        
        $reserves = $reservelogic->reserve();
        $reservelogic->shopDelete($id);
        $rankinglogic->rankingReserveDelete($shop_id);
        
        return response()->json(['reserve' => $reserve]);
    }
}
