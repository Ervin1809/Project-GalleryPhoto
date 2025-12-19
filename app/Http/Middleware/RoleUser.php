<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\UserRole;

class RoleUser
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu');
        }

        // cocokkan enum dengan parameter route
        if (Auth::user()->role->value !== $role) {
            abort(403, 'Akses terbatas');
        }

        return $next($request);
    }
}
