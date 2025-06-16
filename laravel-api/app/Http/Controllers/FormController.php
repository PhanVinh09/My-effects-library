<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FormController extends Controller
{

    public function index(Request $request)
    {
        $query = Form::query();

        if ($request->has('search') && $request->search != '') {
            $search = trim($request->search);

            if (Str::length($search) > 100) {
                return redirect()->route('forms.index')->withInput()->with('error', 'Ký tự giới hạn tìm kiếm là 100 !!');
            }
            $query->where('form_name', 'like', '%' . $request->search . '%');
        }
        $forms = $query->orderBy('created_at', 'desc')->paginate(10);
        $page = $request->query('page');
        if (!is_null($page)) {
            if (!ctype_digit($page) || $page < 1 || $page > $forms->lastPage()) {
                return redirect()->route('forms.index')->withInput()->with('error', 'Trang không tồn tại!');
            }
        }

        $forms_name = Form::select('form_name')->distinct()->pluck('form_name');
        $types = Form::select('type')->distinct()->pluck('type');

        if ($request->has('search') && $request->search != '' && $forms->isEmpty()) {
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
            'author.required' => 'Author tối đa là 100 ký tự',
            'author.max' => 'Author tối đa là 100 ký tự',
            'form_name.required' => 'Form_name không được để trống',
            'form_name.max' => 'Form_name tối đa là 100 ký tự',
            'type.required' => 'Type không được để trống',
            'type.max' => 'Type tối đa là 100 ký tự',
            'title.max' => 'title tối đa là 255 ký tự',
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
        try {
            $validated = $request->validate([
                'author' => 'required|string|max:100',
                'form_name' => 'required|string|max:100',
                'type' => 'required|string|max:100',
                'title' => 'nullable|string|max:255',
                'link' => 'nullable|string|max:60000',
                'html' => 'nullable|string|max:60000',
                'css' => 'nullable|string|max:60000',
                'js' => 'nullable|string|max:60000',
                'updated_at' => 'required'
            ], [
                'author.required' => 'Author tối đa là 100 ký tự',
                'author.max' => 'Author tối đa là 100 ký tự',
                'form_name.required' => 'Form_name không được để trống',
                'form_name.max' => 'Form_name tối đa là 100 ký tự',
                'type.required' => 'Type không được để trống',
                'type.max' => 'Type tối đa là 100 ký tự',
                'title.max' => 'title tối đa là 255 ký tự',
                'link.max' => 'Link tối đa là 60000 ký tự',
                'html.max' => 'HTML tối đa là 60000 ký tự',
                'css.max' => 'CSS tối đa là 60000 ký tự',
                'js.max' => 'Js tối đa là 60000 ký tự',
            ]);
            $forms = Form::findOrFail($id);

            //lost update
            $clientTimestamp = Carbon::parse($validated['updated_at']);
            if (!$forms->updated_at->equalTo($clientTimestamp)) {
                return redirect()->route('forms.index')->with('error', 'Cập nhật không thành công. Dữ liệu đã bị thay đổi bởi người khác.');
            }
            unset($validated['updated_at']);

            $forms->update($validated);
            return redirect()->route('forms.index')->with('success', 'Cập nhật form thành công');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('forms.index')->with('error', 'Dữ liệu không còn tồn tại (đã bị xoá).');
        }
    }

    public function destroy($id)
    {
        $forms = Form::findOrFail($id);
        $forms->delete();
        return redirect()->route('forms.index')->with('success', 'Xoá form thành công');
    }
}
