<?php

namespace App\Http\Middleware;

use Closure;

class AppToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->header('AppToken'))
        {
            if($request->header('AppToken') ==  "pbMSeUfUP6Nmfoz2ScxtTPOj8N5WrDXVLBtynWIc")
            {
                return $next($request);
            }
        }

        return response(array('status' => false));
    }
}
