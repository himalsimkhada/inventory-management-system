<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    // Index Page
    public function index(){
        Session::put('admin_page', 'category');
        return view ('admin.category.index');
    }
}
