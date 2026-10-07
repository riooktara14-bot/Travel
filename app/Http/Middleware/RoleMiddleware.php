<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        foreach ($roles as $role) {
            if ($role === 'owner' && $user->isOwner()) {
                return $next($request);
            }

            if ($role === 'finance' && $user->isFinance()) {
                return $next($request);
            }

            if ($role === 'admin' && ! $user->isFinance() && ($user->isOwner()
                || in_array(strtolower((string) $user->getRawOriginal('role')), ['admin', 'super admin'], true)
                || $user->role()->whereIn('nama_peran', ['Admin', 'Super Admin'])->exists())) {
                return $next($request);
            }
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
