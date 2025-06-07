<?php

namespace App\Http\Controllers;

use App\Models\Effect;
use Illuminate\Http\Request;

class EffectController extends Controller
{
    // Hàm trả về JSON cho API (giữ nguyên)
    public function apiIndex()
    {
        return response()->json(Effect::all());
    }

    // Hàm trả view blade và truyền dữ liệu
    public function index()
    {
        $effects = Effect::all();
        $effects_name = Effect::select('effect_name')->distinct()->pluck('effect_name');
        $types = Effect::select('type')->distinct()->pluck('type');
        return view('admin.management_list.effect', compact('effects', 'types', 'effects_name'));
    }

    public function show($id) {}

    public function store(Request $request)
    {
        //kiểm tra dữ liệu nhập vào
        $request->validate([
            'author' => 'required|string|max:100',
            'effect_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'link' => 'nullable|string',
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'js' => 'nullable|string'
        ], [
            'author.max' => 'Author tối đa là 100 ký tự',
            'effect_name.required' => 'Effect_name không được để trống',
            'effect_name.max' => 'Effect_name tối đa là 100 ký tự',
            'type.required' => 'Type không được để trống',
            'type.max' => 'Type tối đa là 100 ký tự',
            'title.required' => 'title tối đa là 255 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.required' => 'Author tối đa là 100 ký tự',

        ]);

        Effect::create([
            'author' => $request->author,
            'effect_name' => $request->effect_name,
            'type' => $request->type,
            'title' => $request->title,
            'link' => $request->link,
            'html' => $request->html,
            'css' => $request->css,
            'js' => $request->js
        ]);

        return redirect()->route('effects.index')->with('success', 'Thêm hiệu ứng thành công');
    }

    public function edit($id)
    {
        $effect = Effect::findOrFail($id);
        return view('admin.management_list.effect', compact('effect'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'effect_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'link' => 'nullable|string',
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'js' => 'nullable|string'
        ]);

        $effect = Effect::findOrFail($id);
        $effect->update($validated);

        return redirect()->route('effect.index')->with('success', 'Sửa Hiệu Ứng Thành Công!');
    }

    public function destroy($id)
    {
        Effect::destroy($id);
        return response()->json(null, 204);
    }
}
