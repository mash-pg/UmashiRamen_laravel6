<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Logic\ReserveLogic;
use App\Logic\OkiniLogic;
use App\Logic\CommonLogic;
use App\Logic\RankingLogic;

use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Category;
use App\Models\Ranking;
use App\Models\Okini;
use DB;

class OkiniController extends Controller
{
    //お気に入り登録
    public function shopOkiniInsert(Request $request,
                                    ReserveLogic $reservelogic,
                                    OkiniLogic $okinilogic,
                                    RankingLogic $rankinglogic,
                                    CommonLogic $commonlogic){

        $shofindex = new ShopIndexController();
        $auth = $shofindex->authInfo();
        //変数定義
        $okini = $okinilogic->okini($auth);
        $shop_id = $request['shop']['shop_id'];

        list($count_reserve,$count_okini) = $commonlogic->reserveCount($shop_id);
        $okiniinfo = $okinilogic->okiniExists($auth,$shop_id);
        $rankinginfo = $rankinglogic->rankingExists($shop_id);

        //もしユーザーがランキング登録されていない場合
        if($okiniinfo){
            return \redirect();
        }else{
            if(!$rankinginfo){
                if($count_okini === 0){
                    $okinis = $rankinglogic->rankingUpdate($shop_id,$count_reserve);                   
                }
                $okinis = $rankinglogic->rankingCreate($shop_id,$count_reserve);                   
            }else {
                $okinis = $rankinglogic->rankingCreateReserve($shop_id,$count_okini,$count_reserve);
            }
            $okinis = $okinilogic->okiniShop($auth,$shop_id);
        }   
        return response()->json(['okinis' => $okinis]);
    }

    //お気に入り登録
    public function shopOkiniShow(Shop $shop){
        $shofindex = new ShopIndexController();
        $auth = $shofindex->authInfo();

        if($auth === 1){
            return view("user/top");
        }

        return response()->json(['shop' => $shop]);
    }

    //お気に入り取消
    public function shopOkiniDeleteShow(Okini $okini,
                                        OkiniLogic $okinilogic,
                                        RankingLogic $rankinglogic){
        
        $shofindex = new ShopIndexController();
        $auth = $shofindex->authInfo();
        
        $okini_id = $okini['id'];
        $shop_id = $okini['shop_id'];

        if($auth === 1){
            return view("user/top");
        }

        $okinilogic->okiniDelete($okini_id);
        $count_okini = $rankinglogic->rankingCount($shop_id);
        $rankinglogic->rankingUpdateDelete($shop_id,$count_okini);

        return response()->json(['okini' => $okini]);
    }
}
