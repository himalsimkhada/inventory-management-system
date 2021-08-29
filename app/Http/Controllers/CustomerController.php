<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller {
    //
    public function index() {
        return view('admin.customer.index');
    }

    public function addEdit(Request $request) {
        if ($request->isMethod('post')) {
            # code...
        } elseif ($request->isMethod('get')) {
            return view('admin.customer.addEdit');
        }
    }
}
