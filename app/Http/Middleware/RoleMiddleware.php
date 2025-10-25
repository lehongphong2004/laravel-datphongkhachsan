<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = session('vai_tro'); // Lấy vai trò hiện tại trong session

        // Nếu vai trò người dùng không nằm trong danh sách được phép
        if (!in_array($userRole, $roles)) {
            return redirect('/login')->with('error', 'Bạn không có quyền truy cập');
        }

        return $next($request);
    }
}
