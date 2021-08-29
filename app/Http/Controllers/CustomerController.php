<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    //
    public function index()
    {
        Session::put('admin_page', 'Customer');
        return view('admin.customer.index');
    }
    public function get()
    {
        $data = Customer::all()->sortByDesc('id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function addEdit(Request $request)
    {
        if ($request->isMethod('post')) {
            # code...
        } elseif ($request->isMethod('get')) {
            return view('admin.customer.addEdit');
        }
    }
}
