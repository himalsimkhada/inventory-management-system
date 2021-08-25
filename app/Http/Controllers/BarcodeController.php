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
        $id = $request->input('id');
        $barcode = ProductAttributes::whereIn('id', $id)->get();
        return response()->json($barcode);
    }
}
