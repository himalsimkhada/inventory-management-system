<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller {
    //
    public function index() {
        Session::put('admin_page', 'Customer');
        return view('admin.customer.index');
    }
    public function get() {
        Session::put('admin_page', 'Customer Index');
        $data = Customer::all()->sortByDesc('id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function addEdit(Request $request) {
        Session::put('admin_page', 'Customer Add/Edit');
        if ($request->isMethod('post')) {
            # code...
        } elseif ($request->isMethod('get')) {
            return view('admin.customer.addEdit');
        }
    }

    public function store(Request $request) {
        $data = $request->all();
        if ($request->isMethod('post')) {
            $rule = [
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'email' => 'required|email',
            ];
            $customMessage = [
                'fname.required' => 'Please Enter Customer First Name.',
                'lname.required' => 'Please Enter Customer Last Name.',
                'email.required' => 'Please Enter Customer Email Address',
                'email.email' => 'Input must be valid Email address.',
            ];
            $this->validate($request, $rule, $customMessage);
            $customer = new Customer();
            $customer->firstname = $data['fname'];
            $customer->lastname = $data['lname'];
            $customer->phone_number = $data['phone_number'];
            $customer->address = $data['address'];
            $customer->group = $data['group'];
            $customer->email = $data['email'];
            $response = $customer->save();

            // return response()->json($response);
            return redirect()->back();
        }
    }
}
