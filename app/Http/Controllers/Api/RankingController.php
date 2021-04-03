<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Logic\RankingLogic;
use Illuminate\Support\Facades\Log;

class RankingController extends Controller
{
    public function shopReserve(RankingLogic $rankinglogic){
        //予約ランキング
        list($shops,$okinis) = $rankinglogic->shopRanking();        
        return response()->json(['shops' => $shops ,'okinis' => $okinis]);
    }
}
