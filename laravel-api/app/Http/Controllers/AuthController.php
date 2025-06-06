<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        $login_type = 'name';

        $user = User::where($login_type, $request->name)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('effects.index')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu sai
        return back()->withErrors([
            'login_input' => 'Sai tài khoản hoặc mật khẩu.'
        ])->with('login', 'Sai tài khoản hoặc mật khẩu.');
    }
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:6|max:100|unique:users,name',
            'password' => 'required|string|min:6|max:30|confirmed',
        ], [
            'name.required' => 'Tài khoản là bắt buộc.',
            'name.unique'   => 'Tài khoản đã tồn tại.',
        ]);

        $isFirstUser = User::count() === 0;

        $name = User::create([
            'name' => $request->name,
            'password'  => Hash::make($request->password),
            'role'     => $isFirstUser ? 'admin' : 'user'
        ]);

        return redirect()->route('auth.login')->with('message', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}
