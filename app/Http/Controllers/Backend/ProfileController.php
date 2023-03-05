<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    // method untuk menampilkan halaman adminprofile
    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = Admin::find($id); //hanya menampilkan data admin yang login
        return view('backend.profile.profile-view', compact('adminData'));
    }

    // method untuk menampilkan halaman adminprofile
    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = Admin::find($id);
        $data->nama = $request->nama;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/admin-images/'.$data->profile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin-images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Work Berhasil Bang',
            'alert-type' => 'success',
        );

        // redirect halamanjika profile berhassil do ubah
        return redirect()->route('admin.profile')->with($notification);
    }

    // methoduntuk menampilkan halaman ubah password
    public function AdminChangePassword(){
        return view('backend.profile.admin-change-password');
    }

    // method untuk mengubah password admin
    public function AdminUpdateChangePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find(Auth::id());
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        }else{
            return redirect()->back();
        }
    }

    public function AllUsers()
    {
        $users = User::latest()->get();
        return view('backend.user.all-users', compact('users'));
    }
}
