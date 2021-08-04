<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Str;
use DataTables;

class CategoryController extends Controller
{
    public function category(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if($data['id'] == null){
                $category = new Category();
                $category->category_name = $data['name'];
                $category->category_code = $data['code'];
                $category->slug = Str::slug($data['name'], '-');
                $category->status = $data['status'];
                $category->save();
                Session::flash('info_message', 'Category Successfully Created');
                return redirect()->back();
            }else{
                $category = Category::findorfail($data['id']);
                $category->category_name = $data['name'];
                $category->category_code = $data['code'];
                $category->slug = Str::slug($data['name'], '-');
                $category->status = $data['status'];
                $category->save();
                Session::flash('info_message', 'Category Successfully Updated');
                return redirect()->back();
            }
        }
        return view('admin.category');
    }

    public function getCategory(){
        $data = Category::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a class="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#" data-id="'. $row['id'] .'" id="edit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary mx-4" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </a>
                <a class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#" data-id="'. $row['id'] .'" id="delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
//        if($id == null){
//            $category = Category::all();
//            $data = [];
//            foreach($category as $value){
//                $data[] = [
//                    "name" => $value->category_name,
//                    "code" => $value->category_code,
//                    "status" => $value->status,
//                ];
//            }
//            $dataArray = [
//                'data' => $data,
//            ];
////            echo json_encode($dataArray);
//            return response()->json($data);
//        }else{
//            $category = Category::findorfail($id);
//        }
    }

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
        $categories = Category::paginate(10);
        return view('admin.category.viewCategory', ['categories' => $categories]);
    }
}
