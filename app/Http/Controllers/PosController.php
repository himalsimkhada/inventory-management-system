<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{
    public function index(){
        Session::put('admin_page', 'POS');
        $category = Category::all()->sortByDesc("name");
        $brand = Brand::all()->sortByDesc("name");
        return view('admin.pos.index', ['category' => $category, 'brand' => $brand]);
    }
}
