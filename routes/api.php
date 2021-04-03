<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

/* 
下記はコントローラーに変更予定
*/
//初期お店一覧取得

Route::get('/user/ranking','Api\RankingController@shopReserve');

//予約処理
Route::post('/user/shops/reserve/', 'Api\ReserveController@shopReserveInsert');

Route::get('/user/shops/reserve/{shop}','Api\ReserveController@shopReserveShow');

Route::get('/user/shops/delete/{reserve}','Api\ReserveController@shopReserveDeleteShow');

//お気に入り処理
Route::post('/user/shops/okini/','Api\OkiniController@shopOkiniInsert');

Route::get('/user/shops/okini/{shop}','Api\OkiniController@shopOkiniShow');

Route::get('/user/shops/okini/delete/{okini}','Api\OkiniController@shopOkiniDeleteShow');

//お店一覧
Route::get('/user/category/tonkotu','Api\ShopIndexController@shopCategory');

Route::get('/user/shops/{shop}','Api\ShopIndexController@shopDetail');

Route::get('/user/shops','Api\ShopIndexController@shopIndex');

Route::get('/user/list','Api\ShopIndexController@shopList');

Route::get('/user/shops/reserve/info/{reserve}','Api\ShopIndexController@shopReserveDetail');


