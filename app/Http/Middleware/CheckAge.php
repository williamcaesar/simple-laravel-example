<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->age == 200) {
            return redirect('home');
        }

        return $next($request);
    }
}
