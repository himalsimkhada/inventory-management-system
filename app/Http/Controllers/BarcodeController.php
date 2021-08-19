<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarcodeController extends Controller
{
    public function index(){
        Session::put('admin_page', 'Barcode');
        return view('admin.barcode.index');
    }

    
}
