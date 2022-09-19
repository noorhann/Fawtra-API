<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Request;

class Authenticate extends Middleware
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guard('api')->check() ) 
        {
            return $next($request);

        }
        return response()->json(['status'=>false,
        'message'=>trans('Unauthorized user'),
        'code'=>401],
        401);
    }
}
