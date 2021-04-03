<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();

        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request)
    {
        return redirect(route('user.login'));
    }

    public function username()
    {
        // もし、DBに別の名前でユーザー名のカラムを作っていたらここを変える。
        return 'user_name';
    }

    protected function credentials(Request $request)
    {
        // フォームからの値を取得
        $username = $request->input($this->username());
        $password = $request->input('password');
        // usernameがemail形式かを判定
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            // email形式の場合は連想配列のkey=emailに値を渡す
            return  ['email' => $username, 'password' => $password];
        } else {
            // email形式でない場合は連想配列のkey=nameに値を渡す
            return [$this->username() => $username, 'password' => $password];
        }
    }
}
