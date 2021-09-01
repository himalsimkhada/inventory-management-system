<?php

namespace App\Http\Controllers;

use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class CustomerGroupController extends Controller {
    public function index() {
        Session::put('admin_page', 'Group');
        return view('admin.customer.group');
    }

    public function get(Request $request) {
        if ($request->isMethod('post')) {
            $data = CustomerGroup::findorfail($request->input('id'));
            return response()->json($data);
        } else {
            $data = CustomerGroup::all()->sortByDesc('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button class="btn btn-primary mr-2" data-toggle="modal" data-target="#groupModal" data-id="' . $row['id'] . '" id="edit">Edit</button><a class="btn btn-danger" href="' . route('group.destroy', ['id' => $row['id']]) . '" id="delete">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request) {
        $data = $request->all();
        $rule = [
            'name' => 'required|max:255',
            'percentage' => 'required',
        ];
        $customMessage = [
            'name.required' => 'Please Enter Customer Group Name.',
            'percentage.required' => 'Please Enter Percentage.',
        ];
        $this->validate($request, $rule, $customMessage);
        if ($data['id'] == '') {
            $group = new CustomerGroup();
            $group->name = $data['name'];
            $group->percentage = $data['percentage'];
            $response = $group->save();

            return response()->json($response);
        } else {
            $group = CustomerGroup::findorfail($data['id']);
            $group->name = $data['name'];
            $group->percentage = $data['percentage'];
            $response = $group->save();

            return response()->json($response);
        }
    }

    public function destroy($id) {
        $delete = CustomerGroup::where('id', $id)->delete();

        return redirect()->back();
    }
}
