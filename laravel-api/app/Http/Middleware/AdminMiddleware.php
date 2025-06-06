<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Nếu chưa đăng nhập thì redirect về login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Nếu đăng nhập rồi nhưng không phải admin
        if (Auth::user()->role !== 'admin') {
            // Có thể trả về trang lỗi 403 hoặc redirect về trang khác
            abort(403, 'Bạn không có quyền truy cập.');
            // Hoặc redirect về trang khác, ví dụ:
            // return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
        }

        // Nếu đúng là admin thì cho qua
        return $next($request);
    }
}
