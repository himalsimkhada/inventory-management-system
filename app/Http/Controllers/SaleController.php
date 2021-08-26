<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller {
    public function index() {
        Session::put('admin_page', 'Sale');

        return view('admin.sales.index');
    }

    public function pos() {
        Session::put('admin_page', 'pos');

        return view('admin.sales.pos');
    }
}
