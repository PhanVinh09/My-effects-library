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
        return view('admin.management_list.effect', compact('effects'));
    }

    public function show($id)
    {
        $effect = Effect::findOrFail($id);
        return response()->json($effect);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'effect_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'link' => 'nullable|string',
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'js' => 'nullable|string',
        ]);

        $effect = Effect::create($validated);
        return response()->json($effect, 201);
    }

    public function update(Request $request, $id)
    {
        $effect = Effect::findOrFail($id);

        $effect->update($request->all());

        return response()->json($effect);
    }

    public function destroy($id)
    {
        Effect::destroy($id);
        return response()->json(null, 204);
    }
}
