<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class AdminProfileController extends Controller
{
    //  Admin Profile
    public function profile(){
        $admin = Auth::guard('admin')->user();
        return view ('admin.profile', compact('admin'));
    }

    // Admin Profile Update
    public function profileUpdate(Request $request, $id){
        $data = $request->all();
//        dd($data['image']);
        $admin = Admin::findOrFail($id);
//        dd($admin->image);
        $admin->name = $data['name'];
        $admin->phone = $data['phone'];
        $admin->address = $data['address'];

        $image_path = 'public/uploads/profile/';
        if($admin->image != ""){
//            dd('here1');
            if(!empty($data['image'])){
//                dd('here2');
                if (file_exists($image_path.$admin->image)){
//                    dd('here3');
                    unlink($image_path.$admin->image);
                }
            }
        }

        $random = Str::random(10);
        if($request->hasFile('image')){
            $image_tmp = $request->file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random. '.' . $extension;
                $image_path = 'public/uploads/profile/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $admin->image = $filename;
            }
        }
        $admin->save();
        Session::flash('info_message', 'Profile has been updated successfully');
        return redirect()->back();
    }
}
