<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
// use DataTables;

class UnitController extends Controller
{
    public function index()
    {
        Session::put('admin_page', 'unit');
        $base_unit = Unit::where('base_unit', '=', null)->get();
        return view('admin.unit.index', ['base_units' => $base_unit]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($data['id'] == null) {
                $unit = new Unit();
                $unit->name = $data['name'];
                $unit->short_name = $data['short_name'];
                $unit->base_unit = $data['base_unit'];
                $unit->operator = $data['operator'];
                $unit->operation_value = $data['operation_value'];
                $response = $unit->save();

                return response()->json($response);
            } else {
                $unit = Unit::findorfail($data['id']);
                $unit->name = $data['name'];
                $unit->short_name = $data['short_name'];
                $unit->base_unit = $data['base_unit'];
                $unit->operator = $data['operator'];
                $unit->operation_value = $data['operation_value'];
                $response = $unit->save();

                return response()->json($response);
            }
        }
    }

    public function get(Request $request)
    {
        // dd($request);
        if ($request->isMethod('post')) {
            $data = Unit::findorfail($request->input('id'));

            return response()->json($data);
        } else {
            $data = Unit::all()->sortByDesc('id');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button class="btn btn-primary mr-2" data-toggle="modal" data-target="#unitModal" data-id="' . $row['id'] . '" id="edit">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $response = Unit::where('id', $data['id'])->delete();
            return response()->json($response);
        }
    }
}
