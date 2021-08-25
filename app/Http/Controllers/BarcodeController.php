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
        $data = $request->input('ids');
        $id = str_split($data, 1);
        $barcode = ProductAttributes::whereIn('product_id', $id)->get();
        dd($barcode);
        return response()->json($barcode);
    }
}
