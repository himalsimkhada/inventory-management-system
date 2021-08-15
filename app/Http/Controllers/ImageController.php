<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Img;

class ImageController extends Controller {
    public function store(Request $request) {
        $imagePath = 'public/uploads/product/';
        // $ds = DIRECTORY_SEPARATOR;

        $data = $request->all();
        $productImage = new Image();
        $imageTmp = $data['file'];
        $random = Str::random(10);
        $extension = $imageTmp->getClientOriginalExtension();
        $filename = $random . '.' . $extension;
        $image = $imagePath . $filename;
        Img::make($imageTmp)->save($image);
        $productImage->image = $filename;
        $productImage->product_id = $data['product_id'];
        $productImage->save();
    }

    public function destroy(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $response = Image::where('id', $data['id'])->delete();
            return response()->json($response);
        }
    }
}
