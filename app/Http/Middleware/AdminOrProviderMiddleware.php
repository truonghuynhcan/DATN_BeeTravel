<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrProviderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và có vai trò là admin hoặc provider
        if (Auth::guard('admin')->check() && in_array(Auth::guard('admin')->user()->role, ['admin', 'provider'])) {
            return $next($request);  // Cho phép truy cập
        }

        // Nếu không phải admin hoặc provider, chuyển hướng về trang đăng nhập admin
        return redirect()->route('login_admin')->withErrors('Bạn cần đăng nhập với tư cách admin hoặc provider để truy cập trang này.');
    }
}
