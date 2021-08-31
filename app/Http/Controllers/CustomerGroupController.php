<?php

namespace App\Http\Controllers;

use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerGroupController extends Controller {
    public function index() {
        return view('admin.customer.group');
    }

    public function get() {
        $data = CustomerGroup::all()->sortByDesc('id');
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a class="btn btn-primary mr-2" href="' . route('group.edit', ['id' => $row['id']]) . '" id="edit">Edit</a><a class="btn btn-danger" href="' . route('group.destroy', ['id' => $row['id']]) . '" id="delete">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request) {
        $data = $request->all();
        if ($request->id == null) {
            $group = new CustomerGroup();
            $group->name = $data['name'];
            $group->percentage = $data['percentage'];
            $response = $group->save();

            return response()->json($response);
        } else {
            $group = CustomerGroup::findorfail($request->id);
            $group->name = $data['name'];
            $group->percentage = $data['percentage'];
            $response = $group->save();

            return response()->json($response);
        }
    }

    public function destroy($id)
    {
        $delete = CustomerGroup::where('id', $id)->delete();

        return redirect()->back();
    }
}
