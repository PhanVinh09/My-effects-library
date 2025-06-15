<?php

namespace App\Http\Controllers;

use App\Models\UseInterface;
use Illuminate\Http\Request;

class UseInterfaceController extends Controller
{

    public function index()
    {
        $uis_name = UseInterface::select('ui_name')->distinct()->pluck('ui_name');
        $types = UseInterface::select('type')->distinct()->pluck('type');
        $useInterfaces = UseInterface::all();
        return view('admin.management_list.use_interface', compact('useInterfaces', 'uis_name', 'types'));
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
            'author.max' => 'Author tối đa là 100 ký tự',
            'ui_name.required' => 'UI_name không được để trống',
            'ui_name.max' => 'UI_name tối đa là 100 ký tự',
            'type.required' => 'Type không được để trống',
            'type.max' => 'Type tối đa là 100 ký tự',
            'title.max' => 'title tối đa là 255 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'link.max' => 'Link tối đa là 60000 ký tự',
            'html.max' => 'HTML tối đa là 60000 ký tự',
            'css.max' => 'CSS tối đa là 60000 ký tự',
            'js.max' => 'Js tối đa là 60000 ký tự',
        ]);
        UseInterface::create($validated);
        return redirect()->route('useInterfaces.index')->with('success', 'Thêm useInterfaces thành công!!');
    }

    public function update(Request $request, $id)
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
            'author.max' => 'Author tối đa là 100 ký tự',
            'ui_name.required' => 'UI_name không được để trống',
            'ui_name.max' => 'UI_name tối đa là 100 ký tự',
            'type.required' => 'Type không được để trống',
            'type.max' => 'Type tối đa là 100 ký tự',
            'title.max' => 'title tối đa là 255 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'link.max' => 'Link tối đa là 60000 ký tự',
            'html.max' => 'HTML tối đa là 60000 ký tự',
            'css.max' => 'CSS tối đa là 60000 ký tự',
            'js.max' => 'Js tối đa là 60000 ký tự',
        ]);
        $useInterfaces = UseInterface::findOrFail($id);
        $useInterfaces->update($validated);
        return redirect()->route('useInterfaces.index')->with('success', 'Cập nhật useInterfaces thành công!!');
    }

    public function destroy(UseInterface $useInterface) {}
}
