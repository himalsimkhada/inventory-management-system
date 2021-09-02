<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Image;
use App\Models\Pos;
use App\Models\PosItems;
use App\Models\Product;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DNS1D;
use DNS2D;

class PosController extends Controller {
    public function index() {
        Session::put('admin_page', 'POS');
        $category = Category::all()->sortByDesc("name");
        $brand = Brand::all()->sortByDesc("name");
        $wareHouse = WareHouse::all()->sortByDesc("name");
        $customer = Customer::all()->sortByDesc("name");
        return view('admin.pos.index', ['category' => $category, 'brand' => $brand, 'wareHouse' => $wareHouse, 'customer' => $customer]);
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

    public function store(Request $request) {
        $data = $request->all();

        if ($request->isMethod('post')) {
            $pos = new Pos();
            $pos->customer_id = $data['customer_id'];
            $pos->reference_number = $data['reference_number'];
            $pos->warehouse_id = $data['warehouse_id'];
            $pos->save();

            $lastId = $pos->id; //vakhar insert vako id

            //esma foreach launa parxa ajax bata
            $items = new PosItems();
            $items->pos_id = $lastId;
            $items->product_id = $data['product_id']; //ani yo id xai tae ajax ko table ko through pathauna

            $items->save();

            //end foreach
        }
    }

    public function barcode(Request $request){
        if ($request->isMethod('post')) {
            $response['barcode'] = DNS1D::getBarcodePNG($request->input('refrenceNumber'), "C39+", 1, 33);
            $response['QR'] = DNS2D::getBarcodePNG($request->input('refrenceNumber'), 'PDF417');
            return response()->json($response);
        }
    }
}
