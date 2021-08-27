<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PosController extends Controller {
    public function index() {
        Session::put('admin_page', 'POS');
        $category = Category::all()->sortByDesc("name");
        $brand = Brand::all()->sortByDesc("name");
        return view('admin.pos.index', ['category' => $category, 'brand' => $brand]);
    }

    public function categoryGet(Request $request) {
        $response = [];
        if ($request->input('id') != '') {
            $product = Product::where('category_id', $request->input('id'))->get();
            foreach ($product as $value) {
                $image = Image::where('product_id', $value->id)->first();
                if ($image) {
                    $imageName = $image->image;
                } else {
                    $imageName = '';
                }
                $response[] = [
                    'id' => $value->id,
                    'code' => $value->code,
                    'name' => $value->name,
                    'image' => $imageName,
                    'price' => $value->price,
                ];
            }
        }
        return response()->json($response);
    }

    public function brandGet(Request $request) {
        $response = [];
        if ($request->input('id') != '') {
            $product = Product::where('brand_id', $request->input('id'))->get();
            foreach ($product as $value) {
                $image = Image::where('product_id', $value->id)->first();
                if ($image) {
                    $imageName = $image->image;
                } else {
                    $imageName = '';
                }
                $response[] = [
                    'id' => $value->id,
                    'code' => $value->code,
                    'name' => $value->name,
                    'image' => $imageName,
                    'price' => $value->price,
                ];
            }
        }
        return response()->json($response);
    }
}
