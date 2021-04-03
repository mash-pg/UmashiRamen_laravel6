<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showRegistrationForm()
    {
        return view('user.auth.register');
    }

    protected function validator(array $data)
    {
        $vadation = Validator::make($data, [
            'user_name'     => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:user_tb'],
        ]);
        return $vadation;
    }

    protected function create(array $data)
    {
        $tel = $data['tel1'].'-'.$data['tel2'];

        return User::create([
            'user_id'     => $data['user_id'],
            'user_name'     => $data['user_name'],
            'password' => Hash::make($data['password']),
            'email'    => $data['email'],
            'tel'    => $tel,
            'age'    => $data['age'],
            'sex'    => $data['sex'],
            'dlflag'    => 1,
        ]);
    }
}
