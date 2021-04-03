<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ShopIndexController;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        $shofindex = new ShopIndexController();
        //ログイン情報(user_id)
        $auth = $shofindex->authInfo();
        Log::info('Exception Mash :  '.$exception);
        if ($exception instanceof TokenMismatchException) {
            if($auth === 1){
                Auth::logout();
                Log::info("userauth : ".$auth);
                return response()->view('error.500');    
            }
            Auth::logout();
            Log::info("shopauth : ".$auth);
            return response()->view('error.419');
        }
        if($exception instanceof NotFoundHttpException){
            return response()->view('error.404');
        }
        // if($exception instanceof RouteNotFoundException){
        //     Log::info('Routeエラーだよ');
        //     return response()->view('error.500');
        // }
        if($exception instanceof AuthenticationException){
            if($auth != 1){
                Log::info("userauth Auth : ".$auth);
                return response()->view('user/home');    
            }
            Log::info("shopauth Auth: ".$auth);
            return response()->view('error.419');
        }
        return parent::render($request, $exception);
    }
}
