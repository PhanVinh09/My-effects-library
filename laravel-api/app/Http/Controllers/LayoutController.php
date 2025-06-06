<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function index()
    {
        $layouts = Layout::all();
        return view('admin.management_list.layout', compact('layouts'));
    }

    public function show($id)
    {
        $layout = Layout::findOrFail($id);
        return response()->json($layout);
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

        $layout = Layout::create($validated);
        return response()->json($layout, 201);
    }

    public function update(Request $request, $id)
    {
        $layout = Layout::findOrFail($id);

        $layout->update($request->all());

        return response()->json($layout);
    }

    public function destroy($id)
    {
        Layout::destroy($id);
        return response()->json(null, 204);
    }
}
