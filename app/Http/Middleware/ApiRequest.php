<?php

namespace App\Http\Middleware;

use App\Events\ApiRequestHit;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiRequest
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
        // вызываем событие
        ApiRequestHit::dispatch(
            Auth::user(),
            Carbon::now()
        );

        return $next($request);
    }
}
