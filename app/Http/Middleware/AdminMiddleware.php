<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();
        if ($user->isFinance()) {
            abort(403, 'Finance hanya memiliki akses ke fitur keuangan.');
        }

        if ($user->isOwner() && ! $request->isMethodSafe()) {
            abort(403, 'Owner hanya memiliki akses lihat.');
        }

        $isAdmin = ($user->role_id !== null && $user->role()->whereIn('nama_peran', ['Admin', 'Super Admin'])->exists())
            || in_array(strtolower((string) $user->getRawOriginal('role')), ['admin', 'super admin'], true)
            || $user->isOwner();

        if (! $isAdmin) {
            abort(403, 'Anda tidak memiliki akses admin.');
        }

        return $next($request);
    }
}
