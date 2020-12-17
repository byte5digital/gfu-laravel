<?php

namespace App\Http\Middleware;

use Closure;

class ApiToken
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
        //if api token of request does not equal API_KEY in .env return 401 else let request pass
        if ($request->api_token != env('API_KEY')) {
            return response()->json('Unauthorized', 401);
        } else {
            return $next($request);
        }
    }
}
