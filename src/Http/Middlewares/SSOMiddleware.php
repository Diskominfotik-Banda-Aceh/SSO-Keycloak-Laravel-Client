<?php

namespace DiskominfotikBandaAceh\SSOBandaAcehPHP\Http\Middlewares;

use DiskominfotikBandaAceh\SSOBandaAcehPHP\Services\SSOService;
use Closure;
use Illuminate\Http\Request;

class SSOMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $success = SSOService::mapUserDetail($user);

        if (!$success){
            auth()->logout();
            return redirect()->route('login')->withErrors('Sesi Anda telah habis. Silahkan login kembali.');
        }

        return $next($request);
    }
}
