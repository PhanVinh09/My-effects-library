<?php

namespace App\Http\Controllers;

use App\Models\admin_Management;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = admin_Management::query();

        $query->where('role', 'admin');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $admins = $query->orderBy('created_at', 'desc')->paginate(10);
        if ($request->has('search') && $request->search != '' && $admins->isEmpty()) {
            return redirect()->route('admins.index')->with('warning', 'Không tìm thấy admin nào với có tên là "' . $request->search . '"');
        }
        return view('admin.management_list.admin', compact('admins'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:users,name',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6|max:30',
            'role' => 'required|string|in:admin,admin',
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
        admin_Management::create($validated);

        return redirect()->route('admins.index')->with('success', 'Thêm người dùng thành công');
    }

    public function update(Request $request, $id)
    {
        if ($request->input('code') !== '1010') {
            return redirect()->back()->with('errorCode', 'Có phải admin không đấy !!');
        }
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:100|unique:users,name,' . $id,
                'email' => 'nullable|email|unique:users,email,' . $id,
                'password' => 'required|string|min:6',
                'role' => 'required|string|in:admin,user',
                'membership_level' => 'required|string|in:VIP,Normal',
            ], [
                'name.required' => 'Name không được bỏ trống',
                'name.max' => 'Name tối đa là 100 ký tự',
                'name.unique' => 'Name đã tồn tại',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Password không được để trống',
                'password.min' => 'Password tối thiểu 6 ký tự',
                'role.required' => 'Role không được để trống',
                'role.in' => 'Role không tồn tại',
                'membership_level.required' => 'membership_level không được để trống',
                'membership_level.in' => 'membership_level không tồn tại',
            ]);
            $admin_Management = admin_Management::findOrFail($id);
            $admin_Management->update($validated);
            return redirect()->route('admins.index')->with('success', 'Cập nhật admin thành công');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admins.index')->with('error', 'Cập nhật admin không thành công');
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->input('code') !== '1010') {
            return redirect()->back()->with('errorCode', 'Có phải admin không đấy !!');
        }
        $admin_Management = admin_Management::findOrFail($id);
        $admin_Management->delete();
        return redirect()->route('admins.index')->with('success', 'Xoá admin thành công');
    }
}
