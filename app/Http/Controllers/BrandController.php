<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Brand;
use DataTables;
use Illuminate\Support\Str;
use Image;
use File;

class BrandController extends Controller
{
    public function index(){
        Session::put('admin_page', 'brand');
        return view('admin.brand.index');
    }

    public function store(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
//            dd($data);
            $imageTmp = $request->file('image');
            if($data['id'] == null){
                $brand = new Brand();
                $brand->brand_name = $data['brand_name'];
                $brand->brand_code = $data['brand_code'];
                if($imageTmp != null){
                    $random = Str::random(10);
                    $extension = $imageTmp->getClientOriginalExtension();
                    $filename = $random . '.' . $extension;
                    $imagePath = 'public/uploads/brand/';
                    $image = $imagePath . $filename;
                    Image::make($imageTmp)->save($image);
                    $brand->image = $filename;
                }else{
                    $brand->image = '';
                }
                $brand->status = $data['status'];
                $response = $brand->save();
                return response()->json($response);
            }else{
                $brand = Brand::findorfail($data['id']);
                $brand->brand_name = $data['brand_name'];
                $brand->brand_code = $data['brand_code'];
                if($imageTmp != null){
                    $random = Str::random(10);
                    $extension = $imageTmp->getClientOriginalExtension();
                    $filename = $random . '.' . $extension;
                    $imagePath = 'public/uploads/brand/';
                    $image = $imagePath . $filename;
                    if($brand->image != ""){
                        File::delete($imagePath . $brand->image);
                    }
                    Image::make($imageTmp)->save($image);
                    $brand->image = $filename;
                }
                $brand->status = $data['status'];
                $response = $brand->save();
                return response()->json($response);
            }
        }
    }

    public function get(Request $request){
        if ($request->isMethod('post')) {
            $data = Brand::findorfail($request->input('id'));
            return response()->json($data);
        } else {
            $data = Brand::all()->sortByDesc("id");
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button class="btn btn-primary mr-2" data-toggle="modal" data-target="#brandModal" data-id="' . $row['id'] . '" id="edit">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
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
                ->addColumn('image', function($row) {
                    if($row['image'] != ''){
                        $imageFile = asset('public/uploads/brand/' . $row['image']);
                    }else{
                        $imageFile = asset('public/uploads/no-image.jpg');
                    }
                    $image = '<img class="mr-3 avatar-70 img-fluid rounded" src="'. $imageFile . '">';
                    return $image;
                })
                ->rawColumns(['action', 'status', 'image'])
                ->make(true);
        }

    }

    public function destroy(Request $request){
        if($request->isMethod('post')) {
            $data = $request->all();
            $brand = Brand::findorfail($data['id']);
            $response = Brand::where('id', $data['id'])->delete();
            if($brand->image != ""){
                File::delete('public/uploads/brand/' . $brand->image);
            }
            return response()->json($response);
        }
    }
}
