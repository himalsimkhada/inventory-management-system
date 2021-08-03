<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Str;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $category = new Category();
            $category->category_name = $data['category_name'];
            $category->category_code = $data['category_code'];
            $category->status = $data['category_status'];
            $category->slug = Str::slug($data['category_name'], '-');

            $category->save();
            Session::flash('info_message', 'Category Successfully Created');
            return redirect()->back();
        } else {
            return view('admin.category.addCategory');
        }
    }

    public function view()
    {
        $categories = Category::all();

        return view('admin.category.viewCategory', ['categories' => $categories]);
    }
}
