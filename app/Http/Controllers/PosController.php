<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Image;
use App\Models\Pos;
use App\Models\PosItems;
use App\Models\Product;
use App\Models\ProductAttributes;
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
        if ($request->isMethod('post')) {
            $data = $request->all();
            $pos = new Pos();
            $pos->refrence_number = $data['data']['refrenceNumber'];
            $pos->customer_id = $data['data']['customerId'];
            $pos->warehouse_id = $data['data']['wareHouseId'];
            $pos->item = $data['data']['item'];
            $pos->tax = $data['data']['tax'];
            $pos->discount = $data['data']['discount'];
            $pos->total = $data['data']['total'];
            $pos->recieved_amount = $data['data']['recievedAmount'];
            $pos->change = $data['data']['change'];
            $pos->paidBy = $data['data']['paidBy'];
            $pos->save();

            $lastId = $pos->id;

            if($lastId){
                foreach($data['items'] as $value){
                    $items = new PosItems();
                    $items->pos_id = $lastId;
                    $items->product_id = $value['productId'];
                    $items->sku_id = $value['skuId'];
                    $items->quantity = $value['quantity'];
                    $items->save();
                    if($items->id){
                        $newQuantity = ProductAttributes::where('id', $value['skuId'])->pluck('quantity')[0] - $value['quantity'];
                        ProductAttributes::where('id', $value['skuId'])->update(['quantity' => $newQuantity]);
                    }

                }
                return response()->json('successful');
            } else {
                return response()->json('unsuccessful');
            }

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
