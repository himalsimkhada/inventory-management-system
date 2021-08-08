<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Brands;
use DataTables;

class BrandController extends Controller
{
    public function index(){
        Session::put('admin_page', 'brand');
        return view('admin.brand.index');
    }

    public function store(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            if($data['id'] == null){
                $brand = new Brand();
                $brand->branch_name = $data['branch_name'];
                $brand->branch_code = $data['branch_code'];
                $brand->image = $data['image'];
                $brand->status = $data['status'];
                $brand->save();
                return response()->json(true);
            }else{
                $brand = Brand::findorfail($data['id']);
                $brand->branch_name = $data['branch_name'];
                $brand->branch_code = $data['branch_code'];
                $brand->image = $data['image'];
                $brand->status = $data['status'];
                $brand->save();
                return response()->json(true);
            }
        }
    }

    public function get(Request $request){
        if($request->isMethod('post')){
            $data = Brand::findorfail($request->input('id'));
            return response()->json($data);
        }else{
            $data = Brand::all()->sortByDesc("id");
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button class="btn btn-warning" data-id="'. $row['id'] .'" id="edit" data-bs-toggle="modal" data-bs-target="#formModal">Edit</button>
                    <button class="btn btn-danger" data-id="'. $row['id'] .'" id="delete">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroy(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $brand = Brand::where('id', $data['id'])->delete();
            return response()->json($brand);
        }
    }
}
