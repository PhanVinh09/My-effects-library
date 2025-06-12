<?php

namespace App\Http\Controllers;

use App\Models\User_Management;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User_Management::all();
        return view('admin.management_list.user', compact('users'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:users,name',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6|max:30',
            'role' => 'required|string|in:admin,user',
            'membership_level' => 'required|string|in:VIP,Normal',
        ], [
            'name.required' => 'Name không được bỏ trống',
            'name.max' => 'Name tối đa là 100 ký tự',
            'name.unique' => 'Name đã tồn tại',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password tối thiểu 6 ký tự',
            'password.max' => 'Password tối đa 30 ký tự',
            'role.required' => 'Role không được để trống',
            'role.in' => 'Role không tồn tại',
            'membership_level.required' => 'membership_level không được để trống',
            'membership_level.in' => 'membership_level không tồn tại',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User_Management::create($validated);

        return redirect()->route('users.index')->with('success', 'Thêm người dùng thành công');
    }

    public function show(User_Management $user_Management)
    {
        //
    }

    public function edit(User_Management $user_Management)
    {
        //
    }

    public function update(Request $request, User_Management $user_Management)
    {
        //
    }

    public function destroy(User_Management $user_Management)
    {
        //
    }
}
