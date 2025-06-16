<?php

namespace App\Http\Controllers;

use App\Models\User_Management;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use function PHPUnit\Framework\isEmpty;

class UserManagementController extends Controller
{

    public function index(Request $request)
    {
        $query = User_Management::query();

        $query->where('role', 'user');

        if ($request->has('search') && $request->search != '') {
            $search = trim($request->search);

            if (Str::length($search) > 100) {
                return redirect()->route('users.index')->withInput()->with('error', 'Ký tự giới hạn tìm kiếm là 100 !!');
            }

            $query->where('name', 'like', '%' . $search . '%');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        $page = $request->query('page');
        if (!is_null($page)) {
            if (!ctype_digit($page) || $page < 1 || $page > $users->lastPage()) {
                return redirect()->route('users.index')->withInput()->with('error', 'Trang không tồn tại!');
            }
        }

        if ($request->has('search') && $request->search != '' && $users->isEmpty()) {
            return redirect()->route('users.index')->with('warning', 'Không tìm thấy người dùng nào với có tên là "' . $request->search . '"');
        }
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

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'role' => 'required|string|in:admin,user',
                'membership_level' => 'required|string|in:VIP,Normal',
                'updated_at' => 'required'
            ], [
                'role.required' => 'Role không được để trống',
                'role.in' => 'Role không tồn tại',
                'membership_level.required' => 'membership_level không được để trống',
                'membership_level.in' => 'membership_level không tồn tại',
            ]);

            $user_Management = User_Management::findOrFail($id);

            //lost update
            $clientTimestamp = Carbon::parse($validated['updated_at']);
            if (!$user_Management->updated_at->equalTo($clientTimestamp)) {
                return redirect()->route('users.index')->with('error', 'Cập nhật không thành công. Dữ liệu đã bị thay đổi bởi người khác.');
            }

            unset($validated['updated_at']);
            $user_Management->update($validated);

            return redirect()->route('users.index')->with('success', 'Cập nhật người dùng thành công');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', 'Dữ liệu không còn tồn tại (đã bị xoá).');
        }
    }


    public function destroy($id)
    {
        try {
            $user_Management = User_Management::findOrFail($id);
            $user_Management->delete();
            return redirect()->route('users.index')->with('success', 'Xoá người dùng thành công');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', 'Dữ liệu không còn tồn tại (đã bị xoá).');
        }
    }
}
