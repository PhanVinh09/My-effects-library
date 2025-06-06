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
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ], [
            'name.required' => 'Tài khoản là bắt buộc.',
            'password.required' => 'Mật khẩu là bắt buộc.',
        ]);
        $user = User::where($login_type, $request->name)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('message', 'Xin chào Admin ' . $user->name . '!');
        }
        return back()->withErrors([
            'login_input' => 'Sai tài khoản hoặc mật khẩu.',
        ])->withInput(); 
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
            'name.min' => 'Tài khoản tối thiểu là 6 ký tự.',
            'name.max' => 'Tài khoản tối đa là 100 ký tự.',
            'name.unique'   => 'Tài khoản đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu tối thiểu là 6 ký tự.',
            'password.max' => 'Mật khẩu tối đa là 30 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);

        $isFirstUser = User::count() === 0;

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $isFirstUser ? 'admin' : 'user',
        ]);

        return redirect()->route('auth.login')->with('message', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}
