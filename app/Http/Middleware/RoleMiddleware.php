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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kiểm tra người dùng đã đăng nhập và role của họ có trong danh sách role cho phép hay không
        if (auth()->check() && in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        return redirect('/');  // Redirect về trang chủ nếu người dùng không có quyền
    }
}
