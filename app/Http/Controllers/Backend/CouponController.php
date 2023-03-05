<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    //method untuk menampilkan halaman eola kupon
    public function CouponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupons.coupon-view', compact('coupons'));
    }

    // method untuk proses tambah
    public function CouponStore(Request $request)
    {
        // validasi data
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ], [
            'coupon_name.required' => 'Mohon Diisi Terlebih dahulu',
            'coupon_discount.required' => 'Mohon Diisi Terlebih dahulu',
            'coupon_validity.required' => 'Mohon Diisi Terlebih dahulu',
        ]);

        // proses tambah ke database
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // method untuk menampilkan halaman edit
    public function CouponEdit($id)
    {

        $coupons = Coupon::findOrFail($id);

        return view('backend.coupons.coupon-edit', compact('coupons'));
    }


    // method untuk proses update
    public function CouponUpdate(Request $request, $id)
    {
        Coupon::findOrFail($id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Berhasil Di Edit',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.coupon')->with($notification);
    }

    // method untuk proses delete 
    public function CouponDelete($id)
    {

        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
