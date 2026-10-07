<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
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
        $isSuperAdmin = $user->role()->where('nama_peran', 'Super Admin')->exists()
            || strtolower((string) $user->getRawOriginal('role')) === 'super admin';

        if (! $isSuperAdmin && ! ($user->isOwner() && $request->isMethodSafe())) {
            abort(403, 'Akses hanya tersedia untuk Super Admin.');
        }

        return $next($request);
    }
}
