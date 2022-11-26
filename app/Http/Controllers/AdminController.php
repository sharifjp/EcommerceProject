<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Models\Admin;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function Index()
    {
        return view('admin.admin_login');
    } //End Method



    public function Dashboard()
    {
        return view('admin.index');
    } //End Method

    

    public function Login(Request $request)
    {
        $check = $request -> all();
        if(Auth::guard('admin') -> attempt(['email' => $check['email'], 'password' => $check['password'] ])){
            return redirect() -> route('admin.dashboard') -> with('error', 'Admin Login Successfully.');
        }else{
            return back() -> with('error', 'Invalid Email or Password.');
        }
    } //End Method



    public function Logout()
    {
        Auth::guard('admin') -> logout();
        return redirect() -> route('login_form') -> with('error', 'Admin Logout Successfully.');
    } //End Method



    public function Register()
    {
        return view('admin.admin_register');
    } //End Method



    public function RegisterCreate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect() -> route('login_form') -> with('error', 'Admin Created Successfully.');

    } //End Method



    public function AdminProfile()
    {
        $adminProfile = Admin::find(1);
        return view('admin.admin_profile', compact('adminProfile'));
    } //End Method



    public function AdminProfileEdit()
    {
        $adminProfileEdit = Admin::find(1);
        return view('admin.admin_profile_edit', compact('adminProfileEdit'));
    } //End Method



    public function AdminProfileStore(Request $request)
    {
        $data = Admin:: find(1);
        $data -> name = $request -> name;
        $data -> email = $request -> email;

        if($request -> file('profile_photo_path')){
            $file = $request -> file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data -> profile_photo_path));
            $filename = date('YmdHi').$file -> getClientOriginalName();
            $file -> move(public_path('upload/admin_images'), $filename);
            $data['profile_photo_path'] = $filename;
        }

        $data -> save();

        $notification = array(
            'message' => 'Admin Profile Update Successfully.',
            'alert-type' => 'success',
        );
        return redirect() -> route('admin.profile') -> with($notification);
    } //End Method



    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    } //End Method


    public function AdminUpdatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

       #Match The Old Password
       if(!Hash::check($request->old_password, Admin::find(1)->password)){
        return back()->with("error", "Old Password Doesn't match!");
        }

        #Update the new Password
        $admin = Admin::find(1);
        $admin -> password = Hash::make($request->new_password);
        $admin -> save();
        Auth :: logout();

        return back()->with("status", "Password changed successfully!");
    } //End Method
}
