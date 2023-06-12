<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(getenv('ENABLE_2FA'));
        if (!Session::has('user_2fa') && getenv('ENABLE_2FA') == 'true') {
            return redirect()->route('2fa.index');
        }

        return $next($request);
    }
}
