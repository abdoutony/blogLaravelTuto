<?php

namespace App\Http\Middleware;

use Closure;

class checkIdMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$id)
    {
        if($id >200){
            $newcheck = "old post";
            $request->merge(['newcheck'=>$newcheck]);
        }else{
            $newcheck = "new post";
            $request->merge(['newcheck'=>$newcheck]);
        }
        return $next($request);
    }
}
