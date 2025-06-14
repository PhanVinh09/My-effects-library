<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index(Request $request)
    {
        $query = Form::query();

        if($request->has('search') && $request->search !=''){
            $query->where('form_name', 'like', '%' . $request->search . '%');
        }
        $forms = $query->orderBy('created_at','desc')->paginate(1);
        $forms_name = Form::select('form_name')->distinct()->pluck('form_name');
        $types = Form::select('type')->distinct()->pluck('type');

         if($request->has('search') && $request->search !='' && $forms->isEmpty()){
             return redirect()->route('forms.index')->with('warning', 'Không tìm thấy form nào với từ khoá "' . $request->search . '"');
        }
        return view('admin.management_list.form', compact('forms', 'types', 'forms_name'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'form_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:60000',
            'html' => 'nullable|string|max:60000',
            'css' => 'nullable|string|max:60000',
            'js' => 'nullable|string|max:60000'
        ], [
            'author.max' => 'Author tối đa là 100 ký tự',
            'form_name.required' => 'Form_name không được để trống',
            'form_name.max' => 'Form_name tối đa là 100 ký tự',
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
        Form::create($validated);
        return redirect()->route('forms.index')->with('success', 'Thêm form thành công');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:100',
            'form_name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:60000',
            'html' => 'nullable|string|max:60000',
            'css' => 'nullable|string|max:60000',
            'js' => 'nullable|string|max:60000'
        ], [
            'author.max' => 'Author tối đa là 100 ký tự',
            'form_name.required' => 'Form_name không được để trống',
            'form_name.max' => 'Form_name tối đa là 100 ký tự',
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
        $forms = Form::findOrFail($id);
        $forms->update($validated);
        return redirect()->route('forms.index')->with('success', 'Cập nhật form thành công');
    }

    public function destroy($id)
    {
        $forms = Form::findOrFail($id);
        $forms->delete();
        return redirect()->route('forms.index')->with('success', 'Xoá form thành công');
    }
}
