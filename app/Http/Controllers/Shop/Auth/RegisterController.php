<?php

namespace App\Http\Controllers\Shop\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Rserve;
use App\Models\Category;
use DB;

use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::Shop_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        Log::info('message1');
        $this->middleware('guest:shop');
    }

    protected function guard()
    {
        Log::info('message2');
        $auth2 = auth('shop')->id();
        Log::info($auth2);
        return Auth::guard('shop');
    }

    public function showRegistrationForm()
    {
        Log::info('message3');
        return view('shop.auth.register');
    }

    protected function validator(array $data)
    {
        Log::info('message4');
        return Validator::make($data, [
            'shop_id'      => [ 'required', 'max:32', 'unique:shop_tb'],
            'password'     => [ 'required','max:32', 'confirmed','between:8,32',
                                'regex:/^.*((?=.*[A-Za-z])(?=.*[0-9])|(?=.*[A-Za-z])(?=.*[!_@])|(?=.*[0-9])(?=.*[!_@])).*$/',
                                'unique:shop_tb'],
            'email'        => [ 'required',
                                'max:255',
                                'regex:/^[a-zA-Z0-9_+-]+(.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/',
                                'unique:shop_tb'],
            'shop_name'    =>['required'],
            'shop_address' =>['required'],
            'comments' =>['required'],
            'seat'    =>['required','numeric'],
        ]);
    }

    protected function create(array $data)
    {
        //カウントアップ処理
        // $sql = Rserve::where('reserve_id', 1)
        // ->update(['number' =>  Rserve::where('reserve_id', 1)->value('number')+1]);

        Log::info('message5');
        $categorys = $data['category'];
        $category_data = implode(',',$categorys);

        //カテゴリーテーブルに登録
        Category::create([
            'shop_id'=> $data['shop_id'],
            'category_type'=> $category_data,
        ]);


        Log::info('message6');
        if(!empty($data['tel3'])){
            $tel = $data['tel1'].'-'.$data['tel2'].'-'.$data['tel3'];
        }else{
            $tel = $data['tel1'].'-'.$data['tel2'];
        }
        $avarage_price = $data['price-min'] .'～'.$data['price-max'] ;

        return Shop::create([
            'shop_id'     => $data['shop_id'],
            'password' => Hash::make($data['password']),
            'email'    => $data['email'],
            'area_id' => '1',
            'shop_name' => $data['shop_name'],
            'shop_tel' =>  $tel,
            'shop_address' => $data['shop_address'],
            'comments' => $data['comments'],
            'seat' => 1,
            'show_data' => 0,
            'dlflag' => 1,
            'avarage_price' => $avarage_price,
            'img'=> 'dumy2.png',
            'img1'=> 'dumy2.png',
            'img2'=> 'dumy2.png'
        ]);
    }
}
