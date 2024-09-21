<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\RolesType;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *
     */
    public function handle(Request $request, Closure $next, String $role): Response
    {
        $role = RolesType::from($role);
        if ($request->user()->role == $role) {
            return $next($request);
        }
        abort(403, 'Unauthorized action');
    }
}
