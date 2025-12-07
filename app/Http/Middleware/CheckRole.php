<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole // <--- UBAH INI (Tadi RoleMiddleware)
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        // Cek Role (Array/Multiple Roles)
        if (in_array($request->user()->role, $roles)) {
            return $next($request);
        }

        // Super Admin Bypass
        if ($request->user()->role === 'admin') {
            return $next($request);
        }

        return abort(403, 'Unauthorized action.');
    }
}