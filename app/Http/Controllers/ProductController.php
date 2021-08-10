<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        Session::put('admin_page', 'product');

        return view('admin.product.index');
    }
}
