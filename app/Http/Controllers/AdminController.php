<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Function for Redirect to admin login page
     */
    public function AdminLoginPage()
    {
        return view('admin.login');
    }

    /**
     * For Admin Login
     */
    public function AdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'Wrong Email or Password');
        }
    }

    /**
     *  For Redirect to admin dashboard
     */
    public function AdminDashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * For Admin Logout
     */
    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.page')->with('success', 'Admin Logout Successfully');
    }

    /**
     * For Admin Profile
     */
    public function AdminProfile()
    {
        $admin =  Auth::guard('admin')->user();

        return view('admin.profile', compact('admin'));
    }

    /**
     * For Profile Update
     */
    public function ProfileUpdate(Request $request)
    {
        try {
            $request->validate([
                'name'  => 'required|max:100',
                'email' => 'required|email|unique:admins,email,' . Auth::guard('admin')->id(),
                'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            ]);

            $admin = Auth::guard('admin')->user();
            $fileName = $admin->profile_photo_path;

            if ($request->hasFile('image')) {
                $img = $request->file('image');
                if ($admin->profile_photo_path && file_exists(public_path('images/' . $admin->profile_photo_path))) {
                    unlink(public_path('images/' . $admin->profile_photo_path));
                }
                $fileName = uniqid('img_') . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('images/'), $fileName);
            }

            $admin->update([
                'name'               => $request->name,
                'email'              => $request->email,
                'profile_photo_path' => $fileName,
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            Log::error('Profile Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }

    /**
     * For Redirect to Change Password page
     */
    public function ChangePassword()
    {
        return view('change_password');
    }

    /**
     * For Update Admin Password
     */
    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'Wrong Current Password');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return back()->with('success', 'Password Updated Successfully');
    }
}
