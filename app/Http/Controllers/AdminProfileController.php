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

        if (File::exists($image_path.$current_image)) {
            File::delete($image_path.$current_image);
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
    }
}
