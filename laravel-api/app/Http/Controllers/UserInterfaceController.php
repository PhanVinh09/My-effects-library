<?php

namespace App\Http\Controllers;

use App\Models\UserInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserInterfaceController extends Controller
{
    public function apiIndex()
    {
        return response()->json(UserInterface::all());
    }
    public function index(Request $request)
    {
        $query = UserInterface::query();
        if ($request->has('search') && $request->search != '') {
            $search = trim($request->search);

            if (Str::length($search) > 100) {
                return redirect()->route('userInterfaces.index')->withInput()->with('error', 'Ký tự giới hạn tìm kiếm là 100 !!');
            }
            $query->where('ui_name', 'like', '%' . $request->search . '%');
        }
        $uis_name = UserInterface::select('ui_name')->distinct()->pluck('ui_name');
        $types = UserInterface::select('type')->distinct()->pluck('type');
        $userInterfaces = $query->orderBy('created_at', 'desc')->paginate(10);
        $page = $request->query('page');
        if (!is_null($page)) {
            if (!ctype_digit($page) || $page < 1 || $page > $userInterfaces->lastPage()) {
                return redirect()->route('userInterfaces.index')->withInput()->with('error', 'Trang không tồn tại!');
            }
        }

        if ($request->has('search') && $request->search != '' && $userInterfaces->IsEmpty()) {
            return redirect()->route('userInterfaces.index')->with('warning', 'Không tìm thấy UserInterface nào với từ khoá "' . $request->search . '"');
        }
        return view('admin.management_list.user_interface', compact('userInterfaces', 'uis_name', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'ui_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:60000',
            'html' => 'nullable|string|max:60000',
            'css' => 'nullable|string|max:60000',
            'js' => 'nullable|string|max:60000'
        ], [
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.max' => 'Author tối đa là 100 ký tự',
            'ui_name.required' => 'UI_name không được để trống',
            'ui_name.max' => 'UI_name tối đa là 100 ký tự',
            'type.required' => 'Type không được để trống',
            'type.max' => 'Type tối đa là 100 ký tự',
            'title.max' => 'title tối đa là 255 ký tự',
            'link.max' => 'Link tối đa là 60000 ký tự',
            'html.max' => 'HTML tối đa là 60000 ký tự',
            'css.max' => 'CSS tối đa là 60000 ký tự',
            'js.max' => 'Js tối đa là 60000 ký tự',
        ]);
        UserInterface::create($validated);
        return redirect()->route('userInterfaces.index')->with('success', 'Thêm userInterfaces thành công!!');
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'author' => 'required|string|max:100',
                'ui_name' => 'required|string|max:100',
                'type' => 'required|string|max:100',
                'title' => 'nullable|string|max:255',
                'link' => 'nullable|string|max:60000',
                'html' => 'nullable|string|max:60000',
                'css' => 'nullable|string|max:60000',
                'updated_at' => 'required'
            ], [
                'author.required' => 'Author tối đa là 100 ký tự',
                'author.max' => 'Author tối đa là 100 ký tự',
                'ui_name.required' => 'UI_name không được để trống',
                'ui_name.max' => 'UI_name tối đa là 100 ký tự',
                'type.required' => 'Type không được để trống',
                'type.max' => 'Type tối đa là 100 ký tự',
                'title.max' => 'title tối đa là 255 ký tự',
                'link.max' => 'Link tối đa là 60000 ký tự',
                'html.max' => 'HTML tối đa là 60000 ký tự',
                'css.max' => 'CSS tối đa là 60000 ký tự',
                'js.max' => 'Js tối đa là 60000 ký tự',
            ]);
            $userInterfaces = UserInterface::findOrFail($id);

            //lost update
            $clientTimestamp = Carbon::parse($validated['updated_at']);
            if (!$userInterfaces->updated_at->equalTo($clientTimestamp)) {
                return redirect()->route('userInterfaces.index')->with('error', 'Cập nhật không thành công. Dữ liệu đã bị thay đổi bởi người khác.');
            }
            unset($validated['updated_at']);

            $userInterfaces->update($validated);
            return redirect()->route('userInterfaces.index')->with('success', 'Cập nhật userInterfaces thành công!!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('userInterfaces.index')->with('error', 'Dữ liệu không còn tồn tại (đã bị xoá).');
        }
    }

    public function destroy($id)
    {
        try {
            $userInterfaces = UserInterface::findOrFail($id);
            $userInterfaces->delete();
            return redirect()->route('userInterfaces.index')->with('success', 'Xoá userInterfaces thành công!!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('userInterfaces.index')->with('error', 'Dữ liệu không còn tồn tại (đã bị xoá).');
        }
    }
}
