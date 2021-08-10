<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        Session::put('admin_page', 'product');

        return view('admin.product.index');
    }

    public function get(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = Product::findorfail($request->input('id'));
            return response()->json($data);
        } else {
            $data = Product::all()->sortByDesc("id");
            dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($data) {
                    return 'N/a';
                })
                ->editColumn('category', function ($data) {
                    return 'N/a';
                })
                ->editColumn('brand', function ($data) {
                    return 'N/a';
                })
                ->editColumn('unit', function ($data) {
                    return 'N/a';
                })
                ->editColumn('tax_type', function ($data) {
                    return 'N/a';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button class="btn btn-primary mr-2" data-id="' . $row['id'] . '" id="edit">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    $status = null;
                    if ($row['status'] == 1) {
                        $status = '<span class="dot" style="color:green;display:inline-block;">Active</span>';
                    } elseif ($row['status'] == 0) {
                        $status = '<span class="dot" style="color:red;display:inline-block;">Inactive</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }
}
