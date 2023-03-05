<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

class CartPageController extends Controller
{
    //menampilkan halaman keranjang
    public function MyCart(){
        return view('frontend.mycart');
    }


    public function GetCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartSubtotal = Cart::subtotal();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartSubtotal' => round($cartSubtotal),
        ));
    }

    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Produk dihapus dari keranjang']);
    }

    // function increment
    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
        }

        return response()->json(['increment']);
    }
    // function increment
    public function CartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
        }

        return response()->json(['decrement']);
    }


    // function untuk kupon
    public function CouponApply(Request $request){
        // variabel kupon berisikan data kupon dngn validity cupon  atau tanggalya leb dr atau sama gngtanggal skrng
        $cupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        // jika kupon name valid maka
        if($cupon){
            // jalankan perintah ini
            Session::put('coupon', [
                'coupon_name' => $cupon->coupon_name,
                'coupon_discount' => $cupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $cupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $cupon->coupon_discount/100)
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Kupon Berhasil Digunakan'
            ));
        }else{
            // jika kupon invalid jalankan ini
            return response()->json(['error' => 'Kupon Kadaluarsa']);
        }
    }


    // function untuk menghtung diskon
    public function CouponCalculation(){
        if(Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    // method untuk menghapus kupon
    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Kupon Berhasil Dihapus']);
    }
}
