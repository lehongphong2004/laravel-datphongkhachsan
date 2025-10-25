<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        // Nếu chưa đăng nhập thì về trang login
        if (!session()->has('taikhoan_id')) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập trước.');
        }

        return $next($request);
    }
}
