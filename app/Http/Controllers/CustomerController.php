<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller {
    public function index() {
        Session::put('admin_page', 'Customer');
        return view('admin.customer.index');
    }
    public function get() {
        $data = Customer::all()->sortByDesc('id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('group', function($row) {
                $group = CustomerGroup::where('id', $row['group_id'])->first();

                return $group->name;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class="btn btn-primary mr-2" href="' . route('customer.edit', ['id' => $row['id']]) . '" id="edit">Edit</a><a class="btn btn-danger" href="' . route('customer.destroy', ['id' => $row['id']]) . '" id="delete">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function addEdit(Request $request) {
        Session::put('admin_page', 'Customer Add/Edit');
        if ($request->isMethod('post')) {
        } elseif ($request->isMethod('get')) {
            if ($request->id == null) {
                $group = CustomerGroup::all();
                return view('admin.customer.addEdit', ['group' => $group]);
            } else {
                $id = $request->id;
                $group = CustomerGroup::all();
                $detail = Customer::where('id', $id)->first();

                return view('admin.customer.addedit', ['detail' => $detail, 'group' => $group]);
            }
        }
    }

    public function getDetail(Request $request) {
        $id  = $request->get('id');

        $detail = Customer::with('group')->where('id', $id)->get();

        return response()->json($detail);
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
            if ($request->id == null) {
                $customer = new Customer();
                $customer->firstname = $data['fname'];
                $customer->lastname = $data['lname'];
                $customer->phone_number = $data['phone_number'];
                $customer->address = $data['address'];
                $customer->group_id = $data['group'];
                $customer->email = $data['email'];
                $response = $customer->save();

                return redirect()->route('customer.index');
            } else {
                $customer = Customer::findorfail($data['id']);
                $customer->firstname = $data['fname'];
                $customer->lastname = $data['lname'];
                $customer->phone_number = $data['phone_number'];
                $customer->address = $data['address'];
                $customer->group_id = $data['group'];
                $customer->email = $data['email'];
                $response = $customer->save();

                return redirect()->route('customer.index');
            }
        }
    }

    public function destroy($id) {
        $delete = Customer::where('id', $id)->delete();

        if ($delete) {
            return redirect()->back();
        } else {
            return redirect();
        }
    }
}
