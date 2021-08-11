<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAttributes;
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
            $data = Product::all()->sortByDesc('id');
            // $data = Image::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($data) {
                    return Image::where('product_id', $data['id'])->first()->image;
                })
                ->editColumn('category_id', function ($data) {
                    if ($data->category_id == null) {
                        return 'N/A';
                    } else {
                        return $data->category->category_name;
                    }
                })
                ->editColumn('brand_id', function ($data) {
                    if ($data->brand_id == null) {
                        return 'N/A';
                    } else {
                        return $data->brand->brand_name;
                    }
                })
                ->editColumn('unit_id', function ($data) {
                    return $data->unit->name;
                })
                ->editColumn('tax_type_id', function ($data) {
                    return $data->tax_type->type;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-info mr-2" id="attributes" href="'. route('product.attr.index', ['id' => $row['id']]) .'">More</a></button><button class="btn btn-primary mr-2" data-id="' . $row['id'] . '" id="edit">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
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

    public function destroy(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Image::where('product_id', $data['id'])->delete();
            ProductAttributes::where('product_id', $data['id'])->delete();
            $response = Product::where('id', $data['id'])->delete();

            return response()->json($response);
        }
    }
}
