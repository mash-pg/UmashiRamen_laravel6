<?php
namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Category;

class ShopIndexLogic extends Model
{
    //お店検索処理
    public function shopIndex($auth,$shop_name){
        $query = Shop::query();
        if(!(empty($shop_name))){
            //入力した値がなんもない場合
            $shops = $query->where('shop_name','like',"%$shop_name%");
            $shops = $shops->paginate(3);
            $flag = 1;
            return [$shops,$flag];
        }
        $shops = $query->paginate(3);
        $flag = 2;
        return [$shops,$flag];
    }

    //予約状況と詳細
    public function shopReserveDetail($shop_id){
        //今日の日付取得
        $today = Carbon::now('Asia/Tokyo');
        $today = $today->format('Y-m-d H:i');

        //予約
        $reserves = Reserve::where('dlflag','1')
        ->where('shop_id',$shop_id)
        ->where('reserve_time','>=',$today)
        ->get();

        return $reserves;
    }

    public function shopCategory($category){
        $shops = Shop::
                where('category_type','like','%'.$category.'%')
                ->join('category_tb','category_tb.shop_id','=','shop_tb.shop_id')
                ->get();
        return $shops;
    }

    public function shopList($auth){
        $reserves = Shop::
        //カラムデータ処理
        where('reserve_tb.dlflag',1)
            ->where('shop_tb.dlflag',1)
            ->where('reserve_tb.user_id',$auth)
            ->join('reserve_tb','reserve_tb.shop_id','=','shop_tb.shop_id')
            ->get();

        $okinis = Shop::
            where('okini_tb.dlflag',1)
            ->where('shop_tb.dlflag',1)
            ->where('okini_tb.user_id',$auth)
            ->join('okini_tb','okini_tb.shop_id','=','shop_tb.shop_id')
            ->get();
        
        return [$reserves,$okinis];
    }
}
