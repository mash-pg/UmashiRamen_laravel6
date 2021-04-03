<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function __construct()
    {
        Log::info('message1234mash');
        Log::info(Auth::user());
        $this->middleware('auth:user');
    }

    public function index()
    {
        Log::info('message4');
        return view('top');
    }
    
}
