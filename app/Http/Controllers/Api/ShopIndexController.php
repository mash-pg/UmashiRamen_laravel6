<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Category;
use App\Models\Ranking;
use App\Models\Okini;
use DB;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Logic\ShopIndexLogic;

class ShopIndexController extends Controller
{

    public function authInfo()
    {
        if(!Auth::user()){
            $user_id = 1;
        }else{
            $user_id = Auth::user()->user_id;
        }
        return $user_id;
    }

    public function shopIndex(Request $request,ShopIndexLogic $shopindexlogic){
        $shofindex = new ShopIndexController();

        $auth = $shofindex->authInfo();
        $shop_name = $request->input('name');

        list($shops,$flag) = $shopindexlogic->shopIndex($auth,$shop_name);
        
        //入力した値が空の場合は、お店情報を返す
        if($flag === 2){
            return $shops;
        }
        return response()->json(['shops' => $shops,'auth' => $auth]);
    }
    
    //編集処理
    public function shopUpdate(Shop $shop,Request $request){
        $shofindex = new ShopIndexController();
        $auth = $shofindex->authInfo();
        $shop->update($request->shop);
        return response()->json(['shop' => $shop]);
    }

    //予約状況と詳細
    public function shopDetail(Shop $shop,
                    ShopIndexLogic $shopindexlogic){
        
        $shofindex = new ShopIndexController();
        $auth = $shofindex->authInfo();
        $shop_id = $shop['shop_id'];


        $reserves = $shopindexlogic->shopReserveDetail($shop_id);
        
        return response()->json(['shop' => $shop,'reserves' => $reserves]);
    }
    

    public function shopCategory(Shop $shop,
                                Category $categorys,
                                ShopIndexLogic $shopindexlogic,
                                Request $request){
        
        $category = $request['category'];
        $shops = $shopindexlogic->shopCategory($category);

        return response()->json(['shops' => $shops]);
    }

    //予約状況とお気に入り状況
    public function shopList(Request $request,
                             Reserve $reserve,
                             ShopIndexLogic $shopindexlogic){
        
        $shofindex = new ShopIndexController();
        $auth = $shofindex->authInfo();
        //予約情報
        list($reserves,$okinis) = $shopindexlogic->shopList($auth);
        return response()->json(['reserves' => $reserves ,'okinis' => $okinis]);
    }

}
