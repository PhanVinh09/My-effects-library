<?php

namespace App\Http\Controllers;

use App\Models\Effect;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EffectController extends Controller
{
    // Hàm trả về JSON cho API (giữ nguyên)
    public function apiIndex()
    {
        return response()->json(Effect::all());
    }

    // Hàm trả view blade và truyền dữ liệu
    public function index(Request $request)
    {
        $query = Effect::query();

        //tìm thấy
        if ($request->has('search') && $request->search != '') {
            $search = trim($request->search);
            
            if(Str::length($search) > 100){
                return redirect()->route('users.index')->withInput()->with('error', 'Ký tự giới hạn tìm kiếm là 100 !!');
            }
            $query->where('Effect_name', 'like', '%' . $request->search . '%');
        }
        $effects = $query->orderBy('id_effect', 'desc')->paginate(10);
        $effects_name = Effect::select('effect_name')->distinct()->pluck('effect_name');
        $types = Effect::select('type')->distinct()->pluck('type');

        //tìm không thấy
        if ($request->has('search') && $request->search != '' && $effects->isEmpty()) {
            return redirect()->route('effects.index')->with('warning', 'Không tìm thấy hiệu ứng nào với từ khoá "' . $request->search . '"');
        }
        return view('admin.management_list.effect', compact('effects', 'types', 'effects_name'));
    }

    public function show($id) {}

    public function store(Request $request)
    {
        //kiểm tra dữ liệu nhập vào
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'effect_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:60000',
            'html' => 'nullable|string|max:60000',
            'css' => 'nullable|string|max:60000',
            'js' => 'nullable|string|max:60000'
        ], [
            'author.max' => 'Author tối đa là 100 ký tự',
            'effect_name.required' => 'Effect_name không được để trống',
            'effect_name.max' => 'Effect_name tối đa là 100 ký tự',
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

        Effect::create($validated);

        return redirect()->route('effects.index')->with('success', 'Thêm hiệu ứng thành công');
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'effect_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:60000',
            'html' => 'nullable|string|max:60000',
            'css' => 'nullable|string|max:60000',
            'js' => 'nullable|string|max:60000'
        ], [
            'author.max' => 'Author tối đa là 100 ký tự',
            'effect_name.required' => 'Effect_name không được để trống',
            'effect_name.max' => 'Effect_name tối đa là 100 ký tự',
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
        $effect = Effect::FindOrFail($id);
        $effect->update($validated);

        return redirect()->route('effects.index')->with('success', 'Cập nhật hiệu ứng thành công');
    }

    public function destroy($id)
    {
        $effect = Effect::FindOrFail($id);
        $effect->delete();
        return redirect()->route('effects.index')->with('success', 'Xoá hiệu ứng thành công');
    }
}
