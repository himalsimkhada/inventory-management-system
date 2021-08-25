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
use DNS1D;

class ProductController extends Controller {
    public function index() {
        Session::put('admin_page', 'Product');
        return view('admin.product.index');
    }

    public function get($id = null) {
        if ($id != '') {
            $category = Category::all()->sortByDesc("name");
            $brand = Brand::all()->sortByDesc("name");
            $unit = Unit::all()->sortByDesc("name");
            $tax = TaxType::all()->sortByDesc("type");
            $editData = Product::findorfail($id);
            $image = Image::where('product_id', $id)->get();
            $variant = ProductAttributes::where('product_id', $id)->get();
            return view('admin.product.addEdit', ['category' => $category, 'brand' => $brand, 'unit' => $unit, 'tax' => $tax, 'editData' => $editData, 'image' => $image, 'variant' => $variant]);
        } else {
            $data = Product::all()->sortByDesc('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {

                    if (Image::where('product_id', $data['id'])->exists()) {
                        $imageFile = asset('public/uploads/product/' . Image::where('product_id', $data['id'])->first()->image);
                    } else {
                        $imageFile = asset('public/uploads/no-image.jpg');
                    }
                    $image = '<span id="' . $data['id'] . '"></span><img class="mr-3 avatar-70 img-fluid rounded" src="' . $imageFile . '">';
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
                ->editColumn('quantity', function ($data) {
                    $attribute = ProductAttributes::where('product_id', $data['id'])->get();

                    $total_quantity = 0;

                    foreach ($attribute as $quantity) {
                        $total_quantity = $total_quantity + $quantity['quantity'];
                    }

                    return $total_quantity;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button id="btnGroupDrop1" data-id="' . $row['id'] . '" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>';
                    $actionBtn .= '<div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">';
                    $actionBtn .= '<a class="dropdown-item" href="' . route('product.detail2', ['id' => $row['id']]) . '" id="edit">View</a>';
                    $actionBtn .= '<a class="dropdown-item" href="' . route('product.edit', ['id' => $row['id']]) . '" id="edit">Edit</a>';
                    $actionBtn .= '<a class="dropdown-item" data-id="' . $row['id'] . '" id="delete">Delete</a></div>';
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
            if ($product->exists()) {
                File::delete('public/uploads/product' . $product->first()->image);
                $product->delete();
            }
            ProductAttributes::where('id', $data['id'])->delete();
            $response = Product::where('id', $data['id'])->delete();
            return response()->json($response);
        }
    }

    public function add() {
        Session::put('admin_page', 'Add Product');
        $category = Category::all()->sortByDesc("name");
        $product = Brand::all()->sortByDesc("name");
        $unit = Unit::all()->sortByDesc("name");
        $tax = TaxType::all()->sortByDesc("type");
        return view('admin.product.addEdit', ['category' => $category, 'brand' => $product, 'unit' => $unit, 'tax' => $tax]);
    }

    public function store(Request $request) {
        if ($request->isMethod('post')) {
            // dd($request->all());
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
            $imageTmp = $request->file('images');
            if ($data['id'] == null) {
                $product = new Product();
                $product->name   = $data['name'];
                $product->code = $data['code'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];
                $product->unit_id = $data['unit_id'];
                $product->tax_type_id = $data['tax_id'];
                $product->price = $data['price'];
                $product->description = $data['description'];
                $store = $product->save();
                $response = ['success' => $store];
                if ($store == true) {
                    if (isset($data['attrId'])) {
                        $count = count($data['attrId']);
                        $insert = [];
                        if ($count > 0) {
                            for ($i = 0; $i < $count; $i++) {
                                $product_name = Product::findorfail($product->id)->name;
                                $sku = strtoupper(substr($product_name, 0, 3)) . '-' . strtoupper(substr($data['size'][$i], 0, 3)) . '-' . strtoupper(substr($data['color'][$i], 0, 3));
                                $barcode = 'data:image/png;base64,'.DNS1D::getBarcodePNG($sku, 'C39+', 1, 33);
                                if ($data['attrId'][$i] == '') {
                                    $insert[] = [
                                        'size' => $data['size'][$i],
                                        'color' => $data['color'][$i],
                                        'quantity' => $data['quantity'][$i],
                                        'additional_price' => $data['additionalPrice'][$i],
                                        'sku' => $sku,
                                        'size' => $data['size'][$i],
                                        'barcode' => $barcode,
                                        'product_id' => $product->id,
                                    ];
                                }
                            }
                            if (!empty($insert)) {
                                ProductAttributes::insert($insert);
                            }
                        }
                    }
                    $response['lastId'] = $product->id;
                }
                return $response;
            } else {
                $product = Product::findorfail($data['id']);
                $product->name = $data['name'];
                $product->code = $data['code'];
                $product->category_id = $data['category_id'];
                $product->brand_id = $data['brand_id'];
                $product->unit_id = $data['unit_id'];
                $product->tax_type_id = $data['tax_id'];
                $product->description = $data['description'];
                $store = $product->save();
                $response = ['success' => $store];
                if ($store == true) {
                    if (isset($data['attrId'])) {
                        $count = count($data['size']);
                        $insert = [];
                        $update = [];
                        if ($count > 0) {
                            for ($i = 0; $i < $count; $i++) {
                                $product_name = Product::findorfail($product->id)->name;
                                $sku = strtoupper(substr($product_name, 0, 3)) . '-' . strtoupper(substr($data['size'][$i], 0, 3)) . '-' . strtoupper(substr($data['color'][$i], 0, 3));
                                $barcode = 'data:image/png;base64,'.DNS1D::getBarcodePNG($sku, 'C39+', 1, 33);
                                if ($data['attrId'][$i] == '') {
                                    $insert[] = [
                                        'size' => $data['size'][$i],
                                        'color' => $data['color'][$i],
                                        'quantity' => $data['quantity'][$i],
                                        'additional_price' => $data['additionalPrice'][$i],
                                        'sku' => $sku,
                                        'size' => $data['size'][$i],
                                        'barcode' => $barcode,
                                        'product_id' => $product->id,
                                    ];
                                } else {
                                    $update = [
                                        'size' => $data['size'][$i],
                                        'color' => $data['color'][$i],
                                        'quantity' => $data['quantity'][$i],
                                        'additional_price' => $data['additionalPrice'][$i],
                                        'sku' => $sku,
                                        'size' => $data['size'][$i],
                                        'barcode' => $barcode,
                                    ];
                                }
                                if (!empty($update)) {
                                    ProductAttributes::where('id', $data['attrId'][$i])->where('product_id', $product->id)->update($update);
                                }
                            }
                            if (!empty($insert)) {
                                ProductAttributes::insert($insert);
                            }
                        }
                    }
                    $response['lastId'] = $product->id;
                }
                if (!empty($data2)) {
                    if ($data['attrId'] == '') {
                        ProductAttributes::insert($data2);
                    } else {
                        ProductAttributes::where('id', $data['attrId'])->update($data2);
                    }
                }
                return $response;
            }
        }
    }

    public function image(Request $request) {
        $data = $request->all();
        $get = Image::where('product_id', $data['id'])->get();
        // dd($get);
        $fileList = [];
        $dir = 'public/uploads/product/';
        foreach($get as $value){
            $file_path = $dir . $value->image;
            $size = filesize($file_path);
            $fileList[] = ['name' => $value->image, 'size' => $size, 'path' => $file_path, 'id' => $value->id];
        }
        return response()->json($fileList);
    }

    public function removeImage(Request $request){
        $id = $request->input('data');
        $image = Image::findorfail($id);
        $response = Image::where('id', $id)->delete();
        if ($image->image != "") {
            File::delete('public/uploads/product/' . $image->image);
        }
        return response()->json($response);
    }

    public function detail(Request $request, $id = null){
        (request()->isMethod('post')) ? $id = $request->input('id') : '';
        $product = Product::with('category', 'brand', 'unit')->where('id', $id)->first();
        // dd($product);
        $image = Image::where('product_id', $id)->get();
        $variant = ProductAttributes::where('product_id', $id)->get();
        $response = [];
        ($product) ? $response['product'] = $product : $response['product'] = '';
        ($image) ? $response['image'] = $image : $response['image'] = '';
        ($variant) ? $response['variant'] = $variant : $response['variant'] = '';
        if(request()->isMethod('post')){
            return response()->json($response);
        }else{
            return view('admin.product.detail', ['detail' => $response]);
        }
    }

    public function productSearch(Request $request){
        $name = $request->input('name');
        $response = Product::where('name', $name)->orWhere('name', 'like', '%' . $name . '%')->get();
        return response()->json($response);
    }

    public function skuSearch(Request $request){
        $response = ProductAttributes::where('product_id', $request->input('id'))->get();
        return response()->json($response);
    }
}
