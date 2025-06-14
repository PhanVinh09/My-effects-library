<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        $layouts = Layout::all();
        $layouts_name = Layout::select('layout_name')->distinct()->pluck('layout_name');
        $types = Layout::select('type')->distinct()->pluck('type');
        return view('admin.management_list.layout', compact('layouts','layouts_name','types' ));
    }

    public function store(Request $request) {
        $validated = $request->validate(['author' => 'required|string|max:100',
            'layout_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:60000',
            'html' => 'nullable|string|max:60000',
            'css' => 'nullable|string|max:60000',
            'js' => 'nullable|string|max:60000'
        ], [
            'author.max' => 'Author tối đa là 100 ký tự',
            'layout_name.required' => 'Layout_name không được để trống',
            'layout_name.max' => 'Layout_name tối đa là 100 ký tự',
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
        Layout::create($validated);
        return redirect()->route('layouts.index')->with('success','Thêm Layout thành công');
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
