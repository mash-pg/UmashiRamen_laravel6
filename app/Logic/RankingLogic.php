<?php

namespace App\Logic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Okini;
use App\Models\Ranking;

class RankingLogic extends Model
{
    //ランキング表示
    public function shopRanking(){
        //cronで集積してトランザクション処理予定
        $shops = Shop::
            //カラムデータ処理
            select('ranking_tb.okini_count','shop_tb.id','shop_tb.comments','ranking_tb.reserve_count',
            'shop_tb.img','shop_tb.shop_name','shop_tb.shop_id')
            ->where('shop_tb.dlflag',1)
            ->join('ranking_tb','ranking_tb.shop_id','=','shop_tb.shop_id')
            ->orderBy('ranking_tb.reserve_count', 'desc')
            ->offset(0)
            ->limit(3)
            ->get();
        $okinis = Shop::
            //カラムデータ処理
            select('ranking_tb.okini_count','shop_tb.id','shop_tb.comments','ranking_tb.reserve_count',
            'shop_tb.img','shop_tb.shop_name','shop_tb.shop_id')
            ->where('shop_tb.dlflag',1)
            ->join('ranking_tb','ranking_tb.shop_id','=','shop_tb.shop_id')
            ->orderBy('ranking_tb.okini_count', 'desc')
            ->offset(0)
            ->limit(3)
            ->get();
        
        return [$shops ,$okinis];
    }

    //ランキング存在確認
    public function rankingExists($shop_id){
        $rankinginfo = Ranking::where('shop_id',$shop_id)->exists();
        return $rankinginfo;
    }

    //ランキング更新
    public function rankingUpdate($shop_id,$count_reserve){
        $okinis = Ranking::where('shop_id',$shop_id)
        ->update([
            'reserve_count' => $count_reserve,
            'okini_count' => 1
        ]);  
        return $okinis;
    }

    //ランキング登録(お気に入り)
    public function rankingCreate($shop_id,$count_reserve){
        //ランキングテーブル登録
        $okinis = Ranking::create([
            'shop_id' => $shop_id,
            'reserve_count' => $count_reserve,
            'okini_count' => 1
        ]);
        return $okinis;
    }

    //ランキング登録(予約)
    public function rankingCreateReserve($shop_id,$count_okini,$count_reserve){
        //ランキングテーブル登録
        $okinis = Ranking::where('shop_id',$shop_id)
        ->update([
            'reserve_count' => $count_reserve,
            'okini_count' => $count_okini + 1
        ]);
        return $okinis;
    }

    //ランキングカウント
    public function rankingCount($shop_id){
        $count_okini = Ranking::where('shop_id',$shop_id)->value('okini_count');
        return $count_okini;
    }

    //ランキング更新（削除した場合）
    public function rankingUpdateDelete($shop_id,$count_okini){
        Ranking::where('shop_id',$shop_id)->update([
            'okini_count' => $count_okini - 1 
        ]);
    }

    //ランキングカウント（予約）
    public function rankingCountReserve($shop_id,$count_okini){
        $ranking = Ranking::create([
            'shop_id' => $shop_id,
            'reserve_count' => 1,
            'okini_count' => $count_okini,
        ]);   
        return $ranking;
    }

    //ランキング予約更新
    public function rankingReserveUpdate($shop_id,$rscount,$count_okini){
        $ranking = Ranking::where('shop_id', $shop_id)
        ->update([
            // 'shop_id' => $request['shop']['shop_id'],
            'reserve_count' => $rscount + 1,
            //お気に入り登録できたら
            'okini_count' =>$count_okini,
        ]);  
        return $ranking;
    }

    //予約取消処理
    public function rankingReserveDelete($shop_id){
        $count_reserve = Ranking::where('shop_id',$shop_id)->value('reserve_count');
        
        Ranking::where('shop_id',$shop_id)->update([
            'reserve_count' => $count_reserve -1 
        ]);
    }
}
