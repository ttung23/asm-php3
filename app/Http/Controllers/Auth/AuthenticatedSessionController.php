<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Tìm người dùng dựa trên email
        // $admin = Admin::where('email', $email)->first();

        $admin = Admin::join('role_detail', 'role_detail.admin_id', '=', 'admins.id')
            ->join('roles', 'roles.id', '=', 'role_detail.role_id')
            ->select("*")
            ->where('email', $email)->first();

        // dd($admin);

        if ($admin && Hash::check($password, $admin->password)) {

            // Mật khẩu khớp, tiến hành đăng nhập
            session(['admin' => $admin]);
            session(['role' => $admin->name]);

            return redirect()->route('admin');

            // Tiếp tục xử lý hoặc trả về kết quả
        } else {
            return redirect()->route('admin.login')->with('error', 'Incorrect account or password');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        session()->forget('admin');
        session()->forget('role');
        return redirect()->route('admin.login');

        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect('/');
    }
}
