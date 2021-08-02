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
    public function profile(){
        $admin = Auth::guard('admin')->user();
        return view ('admin.profile', compact('admin'));
    }

    // Admin Profile Update
    public function profileUpdate(Request $request, $id){
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

        if($admin->image != "") {
            if(!empty($data['image'])) {
                if (File::exists($image_path . $current_image)) {
                    File::delete($image_path . $current_image);
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

<<<<<<< HEAD
    public function passwordChange(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();
            $rule = [
                'c_password' => 'required',
                'new_password' => 'required|required_with:password_con|same:password_con',
                'password_con' => 'required'
            ];

            $customMessage = [
                'c_password.required' => 'Please Enter Current Password',
                'new_password.required' => 'Please Enter a New Password',
                // 'new_password.required_with' => 'Please Enter Confirmation Password',
                // 'new_password.same' => 'Invalid Confirmation Password',
                'password_con.required' => 'Please Enter Confirmation Password',
              ];
              $this->validate($request, $rule, $customMessage);

              $admin = Auth::guard('admin')->user();
              $id = $admin->id;

              if (Hash::check($request->input('c_password'), $admin->password)) {
                $validatedData = $request->validate([
                    'password' => 'required|string|min:8',
                ]);
                $values = [
                    'password' => Hash::make($request->input('new_password'))
                ];
                Admin::where('id', '=', $id)->update($values);
    
                return redirect()->back();
            }
        }

        return view('admin.password');
=======
    public function qwe(){
        $password = Admin::findorfail(1);
        $password->password = '$2y$10$eUwxylnv/CiarqgUoD8mjePSZNfm.EybMNG0fsx5VNyTwSd4CTSei';
        if($password->save()){
            Auth::guard('admin')->logout();
            Session::flash('info_message', 'Password Updated Successfully');
            return redirect()->route('adminLogin');
        }
    }

    public function changePassword(Request $request){
        $data = $request->all();
        if($request->isMethod('post')){
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

            if(!Hash::check($data['cpass'], Auth::guard('admin')->user()->password)){
                return back()->with('error','You have entered wrong password');
            }else{
                $id = Auth::guard('admin')->user()->id;
                $password = Admin::findorfail($id);
//                dd($password);
                $password->password = Hash::make($data['npass']);
                $password->save();
                Auth::guard('admin')->logout();
                Session::flash('info_message', 'Password Updated Successfully');
                return redirect()->route('adminLogin');
            }
        }else{
            return view('admin.password');
        }
>>>>>>> df961a957bdbb6c2e637f2a9e69566314d3b504b
    }
}
