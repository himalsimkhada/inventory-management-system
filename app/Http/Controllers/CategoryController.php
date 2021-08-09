<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DataTables;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        Session::put('admin_page', 'category');
        return view('admin.category.index');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rule = [
                'category_name' => 'required|max:255',
                'category_code' => 'required|max:255',
            ];
            $customMessage = [
                'category_name.required' => 'Please Enter Category Name.',
                'category_code.required' => 'Please Enter Category Code.',
            ];
            $this->validate($request, $rule, $customMessage);

            if ($data['id'] == null) {
                $category = new Category();
                $category->category_name = $data['category_name'];
                $category->category_code = $data['category_code'];
                $category->slug = Str::slug($data['category_name'], '-');
                $category->status = $data['status'];
                $response = $category->save();
                return response()->json($response);
            } else {
                $category = Category::findorfail($data['id']);
                $category->category_name = $data['category_name'];
                $category->category_code = $data['category_code'];
                $category->slug = Str::slug($data['category_name'], '-');
                $category->status = $data['status'];
                $response = $category->save();
                return response()->json($response);
            }
        }
    }

    public function get(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = Category::findorfail($request->input('id'));
            return response()->json($data);
        } else {
            $data = Category::all()->sortByDesc("id");
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button class="btn btn-primary mr-2" data-toggle="modal" data-target="#categoryModal,m" data-id="' . $row['id'] . '" id="edit">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    $status = null;
                    if ($row['status'] == 1) {
                        $status = '<span class="dot" style="color:green;display:inline-block;">Active</span>';
                    } elseif ($row['status'] == 0) {
                        $status = '<span class="dot" style="color:red;display:inline-block;">Inactive</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $response = Category::where('id', $data['id'])->delete();
            return response()->json($response);
        }
    }
}
