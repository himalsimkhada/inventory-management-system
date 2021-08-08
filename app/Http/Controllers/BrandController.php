<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index()
    {
        Session::put('admin_page', 'brand');
        return view('admin.brand.index');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($data['id'] == null) {
                $brand = new Brand();
                $brand->branch_name = $data['brand_name'];
                $brand->branch_code = $data['brand_code'];
                $brand->image = $data['image'];
                $brand->status = $data['status'];
                $brand->save();
                return response()->json(true);
            } else {
                $brand = Brand::findorfail($data['id']);
                $brand->branch_name = $data['brand_name'];
                $brand->branch_code = $data['brand_code'];
                $brand->image = $data['image'];
                $brand->status = $data['status'];
                $brand->save();
                return response()->json(true);
            }
        }
    }

    public function get(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = Brand::findorfail($request->input('id'));
            return response()->json($data);
        } else {
            $data = Brand::all()->sortByDesc("id");
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group"><button class="btn btn-primary" data-toggle="modal" data-target="#brandModal" data-id="' . $row['id'] . '" id="edit">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button></div>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    $statusSign = null;
                    if ($row['status'] == 1) {
                        $statusSign = '<span class="dot" style="color:green;display:inline-block;">Active</span>';
                    } elseif ($row['status'] == 0) {
                        $statusSign = '<span class="dot" style="color:red;display:inline-block;">Inactive</span>';
                    }
                    return $statusSign;
                })
                ->addColumn('image', function($row) {
                    $img_file = asset('public/brand/images/' . $row['image']);
                    $image = '<img class="mr-3 avatar-70 img-fluid rounded" src="'. $img_file . '">';
                    return $image;
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $brand = Brand::where('id', $data['id'])->delete();
            return response()->json($brand);
        }
    }
}
