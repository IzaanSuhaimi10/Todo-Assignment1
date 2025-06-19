<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
{
    $userRole = auth()->user()->role;

    if ($userRole && strtolower($userRole->role_name) === strtolower($role)) {
        return $next($request);
    }

    return redirect('/dashboard')->with('error', 'Access denied.');
}
}
