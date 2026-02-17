<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
        ]);
    }
}
