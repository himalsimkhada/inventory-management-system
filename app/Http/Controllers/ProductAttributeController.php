<?php

namespace App\Http\Controllers;

use App\Models\ProductAttributes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductAttributeController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.product.attributes');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rule = [
                'size' => 'required',
                'color' => 'required',
                'price' => 'required',
                'sku' => 'required'
            ];
            $customMessage = [
                'size.required' => 'Please Enter Size.',
                'color.required' => 'Please Enter Color.',
                'price.required' => 'Please Enter Price',
                'sku.required' => 'Please Enter SKU.'
            ];
            $this->validate($request, $rule, $customMessage);

            if ($data['id'] == null) {
                $product_attribute = new ProductAttributes();
                $product_attribute->size = $data['size'];
                $product_attribute->color = $data['color'];
                $product_attribute->price = $data['price'];
                $product_attribute->sku = $data['sku'];
                $response = $product_attribute->save();
                return response()->json($response);
            } else {
                $product_attribute = ProductAttributes::findorfail($data['id']);
                $product_attribute->size = $data['size'];
                $product_attribute->color = $data['color'];
                $product_attribute->price = $data['price'];
                $product_attribute->sku = $data['sku'];
                $response = $product_attribute->save();
                return response()->json($response);
            }
        }
    }

    public function get(Request $request)
    {
        // dd(request()->id);
        if ($request->isMethod('post')) {
            $data = ProductAttributes::where('product_id', $request->id)->firstorfail();
            return response()->json($data);
        } else {
            $data = ProductAttributes::where('product_id', $request->id)->get()->sortByDesc('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '</button><button class="btn btn-primary mr-2" data-id="' . $row['id'] . '" id="edit" data-toggle="modal" data-target="#attributesModal">Edit</button><button class="btn btn-danger" data-id="' . $row['id'] . '" id="delete">Delete</button>';
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
            $response = ProductAttributes::where('id', $data['id'])->delete();

            return response()->json($response);
        }
    }
}
