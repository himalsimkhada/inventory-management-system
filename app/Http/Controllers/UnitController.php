<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use DB;
// use DataTables;

class UnitController extends Controller
{
    public function index()
    {
        Session::put('admin_page', 'unit');
        $base_unit = Unit::where('base_unit', '=', 0)->get();
        return view('admin.unit.index', ['base_units' => $base_unit]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rule = [
                'name' => 'required|max:255',
                'short_name' => 'required|max:255',
                'base_unit' => 'required',
            ];
            $customMessage = [
                'name.required' => 'Please Enter Unit Name.',
                'short_name.required' => 'Please Enter Unit Short Name.',
                'base_unit.required' => 'Please Choose Base Unit.',
            ];
            $this->validate($request, $rule, $customMessage);

            if ($data['id'] == null) {
                $unit = new Unit();
                $unit->name = $data['name'];
                $unit->short_name = $data['short_name'];
                $unit->base_unit = ($data['base_unit']);
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
                ->editColumn('base_unit', function ($data) {
                    if ($data->base_unit == 0) {
                        return "Main Unit";
                    } else {
                        return $data->unit->name;
                    }
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
            DB::table('units')->where('base_unit', $data['id'])->delete();
            return response()->json($response);
        }
    }
}
