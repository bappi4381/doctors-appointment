<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
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
        return $next($request);
        $method = $request->method();
        $method =  strtr($method, array("GET"=>"get", "POST"=>"post", "PUT"=>"update", "PATCH"=>"update", "DELETE"=>"delete"));

        if($method == 'get' && $request->segment(4)){
            $method = "show";
        }

        $permission = ($request->segment(3) ? $request->segment(3)."-" : null). ($request->segment(5) ? $request->segment(5)."-" : null). $method;
        $permission = $request->own ? $permission.'-own' : $permission.'-global';

        //Permission check
        if(!auth()->user()->can($permission)){
            return response()->json([
                'message' => "You dont have permission for $permission."
            ], 404);
        }

        return $next($request);
    }
}