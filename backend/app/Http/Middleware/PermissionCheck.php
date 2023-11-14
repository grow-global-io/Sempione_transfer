<?php

namespace App\Http\Middleware;

use App\Http\Helpers\Helper;
use Closure;
use Illuminate\Http\Request;

class PermissionCheck
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
        $routeName = $request->route()->getName();
        if(!($request->user()->getAllPermissions()->pluck('name'))->contains($routeName)){
            Helper::sendError('Unauthorized','You are not authorized to this route');
        }
        return $next($request);
    }
}
