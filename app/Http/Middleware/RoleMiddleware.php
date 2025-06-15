<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user(); // dùng Auth facade cho rõ ràng

        // Nếu chưa đăng nhập hoặc không có quyền
        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}
