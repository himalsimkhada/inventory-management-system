<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\TaxType;
use App\Models\Unit;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Intervention\Image\ImageManagerStatic as Img;
use Illuminate\Support\Str;

class ProductController extends Controller {
    public function index() {
        Session::put('admin_page', 'product');
        return view('admin.product.index');
    }

    public function get($id = null) {
        if ($id != '') {
            $category = Category::all()->sortByDesc("name");
            $product = Brand::all()->sortByDesc("name");
            $unit = Unit::all()->sortByDesc("name");
            $tax = TaxType::all()->sortByDesc("type");
            $editData = Product::findorfail($id);
            $image = Image::where('product_id', $id)->first();
            return view('admin.product.addEdit', ['category' => $category, 'brand' => $product, 'unit' => $unit, 'tax' => $tax, 'editData' => $editData, 'image' => $image]);
        } else {
            $data = Product::all()->sortByDesc('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    if (Image::where('product_id', $data['id'])->first()->exists()) {
                        $imageFile = asset('public/uploads/product/' . Image::where('product_id', $data['id'])->first()->image);
                    } else {
                        $imageFile = asset('public/uploads/no-image.jpg');
                    }
                    $image = '<img class="mr-3 avatar-70 img-fluid rounded" src="' . $imageFile . '">';
                    return $image;
                })
                ->editColumn('category_id', function ($data) {
                    if ($data->category_id == null) {
                        return 'N/A';
                    } else {
                        return $data->category->category_name;
                    }
                })
                ->editColumn('brand_id', function ($data) {
                    if ($data->brand_id == null) {
                        return 'N/A';
                    } else {
                        return $data->brand->brand_name;
                    }
                })
                ->editColumn('unit_id', function ($data) {
                    return $data->unit->name;
                })
                ->editColumn('tax_type_id', function ($data) {
                    return $data->tax_type->type;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-info mr-2" id="attributes" href="' . route('product.attr.index', ['id' => $row['id']]) . '">More</a><a href="' . route('product.edit', ['id' => $row['id']]) . '" class="btn btn-primary mr-2" data-id="' . $row['id'] . '" id="edit">Edit</a><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
    }

    public function destroy(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $product = Image::where('id', $data['id']);
            if($product->exists()){
                File::delete('public/uploads/product' . $product->first()->image);
                $product->delete();
            }
            ProductAttributes::where('id', $data['id'])->delete();
            $response = Product::where('id', $data['id'])->delete();
            return response()->json($response);
        }
    }

    public function add() {
        $category = Category::all()->sortByDesc("name");
        $product = Brand::all()->sortByDesc("name");
        $unit = Unit::all()->sortByDesc("name");
        $tax = TaxType::all()->sortByDesc("type");
        return view('admin.product.addEdit', ['category' => $category, 'brand' => $product, 'unit' => $unit, 'tax' => $tax]);
    }

    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $rule = [
                'name' => 'required|max:255',
                'code' => 'required|max:255',
                'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
            ];
            $customMessage = [
                'name.required' => 'Please Enter Product Name.',
                'code.required' => 'Please Enter Product Code.',
                'image.image' => 'Upload image must be an image.',
                'image.max' => 'Upload image must be less than 2MB',
            ];
            $this->validate($request, $rule, $customMessage);
            $data = $request->all();
            $imageTmp = $request->file('image');
            if ($data['id'] == null) {
                $product = new Product();
                $product->name   = $data['name'];
                $product->code = $data['code'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];
                $product->unit_id = $data['unit_id'];
                $product->tax_type_id = $data['tax_id'];
                if ($imageTmp != null) {
                    $random = Str::random(10);
                    $extension = $imageTmp->getClientOriginalExtension();
                    $filename = $random . '.' . $extension;
                    $imagePath = 'public/uploads/product/';
                    $image = $imagePath . $filename;
                    Img::make($imageTmp)->save($image);
                    $product->image = $filename;
                } else {
                    if ($request->input('img_remove_val') == 'removed') {
                        File::delete('public/uploads/product/' . $product->image);
                        $product->image = null;
                    }
                }
                $product->description = $data['description'];
                $response = $product->save();
                Session::flash('info_message', 'Product has been created successfully');
                return redirect('admin/product/view');
            } else {
                $product = Product::findorfail($data['id']);
                $product->name = $data['name'];
                $product->code = $data['code'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];
                $product->unit_id = $data['unit_id'];
                $product->tax_type_id = $data['tax_id'];
                if ($imageTmp != null) {
                    $random = Str::random(10);
                    $extension = $imageTmp->getClientOriginalExtension();
                    $filename = $random . '.' . $extension;
                    $imagePath = 'public/uploads/product/';
                    $image = $imagePath . $filename;
                    if ($product->image != "") {
                        File::delete($imagePath . $product->image);
                    }
                    $product->image = $filename;
                    Img::make($imageTmp)->save($image);
                } else {
                    if ($request->input('img_remove_val') == 'removed') {
                        File::delete('public/uploads/product/' . $product->image);
                        $product->image = null;
                    }
                }
                $product->description = $data['description'];
                $response = $product->save();
                Session::flash('info_message', 'Product has been updated successfully');
                return redirect('admin/product/view');
            }
        }
    }
}
