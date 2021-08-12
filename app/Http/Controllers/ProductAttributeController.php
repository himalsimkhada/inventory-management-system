<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DNS1D;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller {
    public function index(Request $request) {
        return view('admin.product.attributes');
    }

    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rule = [
                'size' => 'required',
                'color' => 'required',
                'price' => 'required',
            ];
            $customMessage = [
                'size.required' => 'Please Enter Size.',
                'color.required' => 'Please Enter Color.',
                'price.required' => 'Please Enter Price',
            ];
            $this->validate($request, $rule, $customMessage);

            if ($data['id'] == null) {
                // dd($data['p_id']);
                $product_attribute = new ProductAttributes();
                $product_attribute->size = $data['size'];
                $product_attribute->color = $data['color'];
                $product_attribute->price = $data['price'];
                $sku = strtoupper(substr(Product::where('id', $data['p_id'])->first()->product_name, 0, 3)) . '-' . strtoupper(substr($data['size'], 0, 3)) . '-' . strtoupper(substr($data['color'], 0, 3));
                $product_attribute->sku = $sku;
                $barcode = DNS1D::getBarcodePNG($sku, 'C39+', 1, 33);
                $name = Str::random(10) . '.png';
                Image::make($barcode)->save('public/uploads/barcode/' . $name);
                $product_attribute->barcode = $name;
                $product_attribute->product_id = $data['p_id'];
                $response = $product_attribute->save();
                return response()->json($response);
            } else {
                $product_attribute = ProductAttributes::findorfail($data['id']);
                $product_attribute->size = $data['size'];
                $product_attribute->color = $data['color'];
                $product_attribute->price = $data['price'];
                if($product_attribute->barcode != ''){
                    File::delete('public/uploads/barcode/' . $product_attribute->barcode);
                }
                $sku = strtoupper(substr(Product::where('id', $data['p_id'])->first()->product_name, 0, 3)) . '-' . strtoupper(substr($data['size'], 0, 3)) . '-' . strtoupper(substr($data['color'], 0, 3));
                $product_attribute->sku = $sku;
                $barcode = DNS1D::getBarcodePNG($sku, 'C39+', 1, 33);
                $name = Str::random(10) . '.png';
                Image::make($barcode)->save('public/uploads/barcode/' . $name);
                $product_attribute->barcode = $name;
                $response = $product_attribute->save();
                return response()->json($response);
            }
        }
    }

    public function get(Request $request) {
        // dd(request()->id);
        if ($request->isMethod('post')) {
            $data = ProductAttributes::where('id', $request->input('id'))->firstorfail();
            return response()->json($data);
        } else {
            $data = ProductAttributes::where('product_id', $request->id)->get()->sortByDesc('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('barcode', function ($row) {
                    $barcode = DNS1D::getBarcodeSVG($row['sku'], 'C39+', 1, 33);
                    return $barcode;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '</button><button class="btn btn-primary mr-2" data-id="' . $row['id'] . '" id="edit" data-toggle="modal" data-target="#attributesModal">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'barcode'])
                ->make(true);
        }
    }

    public function destroy(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $response = ProductAttributes::where('id', $data['id'])->delete();

            return response()->json($response);
        }
    }
}
