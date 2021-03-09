<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenApi
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
        $token = $request->get('token');
        if ($token==md5("difeeding".date('Y-m-d'))) {
            return $next($request);
        }else {
            return response(['message'=>'Token Tidak Sesuai']);
        }
        
    }

}
