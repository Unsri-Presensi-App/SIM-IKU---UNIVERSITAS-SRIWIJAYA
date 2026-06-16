<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * EnsureRole
 * ------------------------------------------------------------------
 * Membatasi akses rute berdasarkan peran (role) pengguna.
 *
 * Pemakaian di routes:
 *   ->middleware('role:operator,admin')      // input data IKU
 *   ->middleware('role:validator,admin')     // validasi Direktorat
 *
 * Admin selalu diizinkan. Bila tidak cocok → 403.
 * ------------------------------------------------------------------
 */
class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        abort_unless($user, 403, 'Anda harus masuk terlebih dahulu.');

        // Admin punya akses penuh; selain itu peran harus termasuk daftar yang diizinkan.
        if ($user->isAdmin() || in_array($user->role, $roles, true)) {
            return $next($request);
        }

        abort(403, 'Peran Anda tidak memiliki akses ke tindakan ini.');
    }
}
