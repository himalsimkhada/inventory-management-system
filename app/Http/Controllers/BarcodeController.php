<?php

namespace App\Http\Controllers;

use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DNS1D;

class BarcodeController extends Controller {
    public function index() {
        Session::put('admin_page', 'Barcode');
        return view('admin.barcode.index');
    }

    public function get(Request $request) {
        $data = $request->all();

        $barcodes = '';

        dd($data['id']);

        foreach ($data['id'] as $id) {
            $product = ProductAttributes::where('product_id', $id)->first();
            $barcodes .= DNS1D::getBarcodeHTML($product->sku, 'C39+', 1, 33) . "<br>";
        }

        return response()->json($barcodes);
    }
}
