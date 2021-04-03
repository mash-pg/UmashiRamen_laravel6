<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    public function index()
    {
        $user = Auth::user(); // 現在認証ユーザー取得
        $per_page = 3; // １ページごとの表示件数
        $users = User::paginate($per_page);
        return view('shop.home')->with('users', $users);
    }

    public function store(Request $request)
    {
        // [ご注意]：バリデーションは省略してます
        // Log::info('test : '.$request);

        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email;
        // Log::info('message');
        $user->password = bcrypt($request->password);

        $result = $user->save();
        return ['result' => $result];
    }

    public function update(Request $request)
    {
        $user = new User();
        // [ご注意]：バリデーションは省略してます
        // Log::info('edit : '.$user);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->filled('password')) { // パスワード入力があるときだけ変更

            $user->password = bcrypt($request->password);

        }

        $result = $user->save();
        return ['result' => $result];
    }

    public function destroy(Request $request)
    {        
        $user->id = $request['id'];
        $result = User::where('id', $request['id'])->delete();
        return ['result' => $result];
    }
}
