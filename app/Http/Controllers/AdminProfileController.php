<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Image;

class AdminProfileController extends Controller
{
    //  Admin Profile
    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    // Admin Profile Update
    public function profileUpdate(Request $request, $id)
    {
        $data = $request->all();
        $admin = Admin::findOrFail($id);
        $admin->name = $data['name'];
        $admin->phone = $data['phone'];
        $admin->address = $data['address'];

        $current_image = $admin->image;
        $image_path = 'public/uploads/profile/';

//        if($admin->image != ""){
////            dd('here1');
//            if(!empty($data['image'])){
////                dd('here2');
//                if (file_exists($image_path.$admin->image)){
////                    dd('here3');
//                    unlink($image_path.$admin->image);
//                }
//            }
//        }

        if ($admin->image != "") {
            if (!empty($data['image'])) {
                if (File::exists($image_path . $current_image)) {
                    File::delete($image_path . $current_image);
                }
            }
        }

        $random = Str::random(10);
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $image_path = 'public/uploads/profile/' . $filename;
                Image::make($image_tmp)->save($image_path);
                $admin->image = $filename;
            }
        }

        $admin->save();

        Session::flash('info_message', 'Profile has been updated successfully');
        return redirect()->back();
    }

    public function qwe()
    {
        $password = Admin::findorfail(1);
        $password->password = '$2y$10$eUwxylnv/CiarqgUoD8mjePSZNfm.EybMNG0fsx5VNyTwSd4CTSei';
        if ($password->save()) {
            Auth::guard('admin')->logout();
            Session::flash('info_message', 'Password Updated Successfully');
            return redirect()->route('adminLogin');
        }
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        if ($request->isMethod('post')) {
            $rule = [
                'cpass' => 'required',
                'npass' => 'required|min:6|different:cpass|same:vpass',
                'vpass' => 'required|same:npass',
            ];
            $customMessage = [
                'cpass.required' => 'Enter Current Password',
                'npass.required' => 'Enter New Password',
                'npass.different' => 'Please Enter New Password',
                'npass.same' => 'Verified Password desnot match',
                'npass.min' => 'Minimum 6 Characters',
                'vpass.required' => 'Confirm New Password'
            ];
            $this->validate($request, $rule, $customMessage);

            if (!Hash::check($data['cpass'], Auth::guard('admin')->user()->password)) {
//                dd('qweqwe');
                return back()->with('error_message', 'Current Password is wrong');
            } else {
                $id = Auth::guard('admin')->user()->id;
                $password = Admin::findorfail($id);
//                dd($password);
                $password->password = Hash::make($data['npass']);
                $password->save();
                Auth::guard('admin')->logout();
                Session::flash('info_message', 'Password Updated Successfully');
                return redirect()->route('adminLogin');
            }
        } else {
            return view('admin.password');
        }
    }

    public function checkPassword(Request $request){
        $data = $request->all();
        $currentPassword = $data['currentPassword'];
        $userId = Auth::guard('admin')->user()->id;
        $checkPassword = Admin::where('id', $userId)->first();
        if(Hash::check($currentPassword, $checkPassword->password)){
            return true;
        }else{
            return false;
        }
    }
}
