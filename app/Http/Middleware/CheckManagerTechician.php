<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckManagerTechician
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
        if ($request->user()->type == "T") {
            return $next($request);
        } elseif ($request->user()->type == "M") {
            return $next($request);
        }
        abort(401, 'This action is unauthorized.');
    }
}
