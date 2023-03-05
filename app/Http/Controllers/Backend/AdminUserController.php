<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminUserController extends Controller
{
    public function AllAdminRole()
    {
        $adminuser = Admin::where('type', 2)->latest()->get();
        return view('backend.role.admin-view', compact('adminuser'));
    }

    public function AddAdminRole()
    {
        return view('backend.role.admin-add');
    }

    public function StoreAdminRole(Request $request)
    {
        $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()). '.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(255.255)->save('upload/admin-images/'.$name_gen);
            $save_url =  $name_gen;

        Admin::insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,

            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupon' => $request->coupon,
            'shipping' => $request->shipping,
            'orders' => $request->orders,
            'cancel' => $request->cancel,
            'return' => $request->return,
            'review' => $request->review,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminrole' => $request->adminrole,
            'setting' => $request->setting,

            'type' => 2,
            'profile_photo_path' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notif = array(
            'message' => 'Admin Berhasil Di tambah',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.view')->with($notif);
    }

    public function EditAdminRole($id)
    {
        $adminuser = Admin::findOrFail($id);
        return view('backend.role.admin-edit', compact('adminuser'));
    }

    public function UpdateAdminRole(Request $request)
    {
        $admin_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('profile_photo_path')) {

            @unlink($old_img);
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()). '.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(255.255)->save('upload/admin-images/'.$name_gen);
            $save_url =  $name_gen;

            Admin::findOrFail($admin_id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,

            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupon' => $request->coupon,
            'shipping' => $request->shipping,
            'orders' => $request->orders,
            'cancel' => $request->cancel,
            'return' => $request->return,
            'review' => $request->review,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminrole' => $request->adminrole,
            'setting' => $request->setting,

            'type' => 2,
            'profile_photo_path' => $save_url,
            'created_at' => Carbon::now()
            ]);

            $notif = array(
                'message' => 'Admin Berhasil Di Edit',
                'alert-type' => 'info'
            );

            return redirect()->route('admin.view')->with($notif);
        } else {
            Admin::findOrFail($admin_id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,

                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupon' => $request->coupon,
                'shipping' => $request->shipping,
                'orders' => $request->orders,
                'cancel' => $request->cancel,
                'return' => $request->return,
                'review' => $request->review,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'adminrole' => $request->adminrole,
                'setting' => $request->setting,

                'type' => 2,
                'created_at' => Carbon::now()
                ]);

                $notif = array(
                    'message' => 'Admin Berhasil Di Edit',
                    'alert-type' => 'info'
                );

                return redirect()->route('admin.view')->with($notif);
        }
    }

    public function DeleteAdminRole($id)
    {
        $adminimg = Admin::findOrFail($id);
        $img = $adminimg->profile_photo_path;
        @unlink($img);

        Admin::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Admin Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notif);
    }

    public function OrderTracking(Request $request)
    {
        $invoice = $request->invoice_number;
        $track = Order::where('invoice_number', $invoice)->first();

        if ($track) {
            return view('frontend.tracking', compact('track'));
        }else{
            $notif = array(
                'message' => 'Kode Invoice Tidak Benar',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notif);
    }
}
