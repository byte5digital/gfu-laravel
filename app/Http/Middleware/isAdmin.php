<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
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
        //checks if user is of admin using isAdmin function of User Model
        if(auth()->user()->isAdmin()){
            //if true, let request pass
            return $next($request);
        }else{
            //if false, redirect to blog.index
            return redirect(route('blog.index'));
        }
        
    }
}
