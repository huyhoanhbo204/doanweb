<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Kiểm tra nếu người dùng không có quyền truy cập
        if (auth()->user()->role == $role) {
            return redirect('/');  // Hoặc bạn có thể redirect về một trang khác
        }

        return $next($request);
    }
}
