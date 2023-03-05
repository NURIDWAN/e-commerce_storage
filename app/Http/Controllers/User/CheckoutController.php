<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    // function untuk menampilkan halaman chekoiut
    public function CheckoutCreate(){
        // jika ada keranjang lebih dr nol aau ada
        if(Cart::total() > 0){
            // jalankan berikut
            $carts = Cart::content();
            $cartQty = Cart::count();
            $cartTotal = Cart::total();

            // Get semua data
            $provinces = Province::all();

            $product = Product::all();

            return view('frontend.checkout-view', compact('carts', 'cartQty', 'cartTotal', 'provinces'));
        }else{
            // jika data keranjang tdk ada
            $notification = array(
                'message' => 'Belanja Minimal Satu Produk',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function CityGetAjax($province_id){
        $ship = City::where('province_id', $province_id)->orderBy('city_name', 'ASC')->get();
        return json_encode($ship);
    }

    public function DistrictGetAjax($city_id){
        $ship = District::where('city_id', $city_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($ship);
    }

    public function CheckoutStore(Request $request){
        // dd($request->all());
        $data = Array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['province_id'] = $request->province_id;
        $data['city_id'] = $request->city_id;
        $data['district_id'] = $request->district_id;
        $data['addres'] = $request->addres;
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        // Stok barang update
        $product = Product::where('id', $request->id_barang);
        $value = $product->value('product_qty');

        $product->update(["product_qty"=>(int) $value - (int) $request->qty_barang]);

        // jika metode bayar yg dipilih stripe/tf
        if($request->payment_method == 'stripe'){
            // hampilkan halaman stripe dan parsing data carttotal
            return view('frontend.payments.stripe-view', compact('data', 'cartTotal'));
            // jika pembayaran cash jalankan perintah
        }elseif($request->payment_method == 'cash'){
            // tampikn halaman cash
            return view('frontend.payments.cod-view', compact('data', 'cartTotal'));
        }else{
            // tampilan halaman manusal
            return view('frontend.payments.manual-view', compact('data', 'cartTotal'));
        }
    }



    public function getkabupaten(Request $request)
    {
        $id_provinsi = $request->id_provinsi;

        $kabupaten = City::where('province_id', $id_provinsi)->get();

        foreach ($kabupaten as  $kab) {
            echo "<option value='$kab->id'>$kab->name</option>";
        }
    }
    public function getkecamatan (Request $request)
    {
        $id_kabupaten = $request->id_kabupaten;

        $kecamatan = District::where('regency_id', $id_kabupaten)->get();

        foreach ($kecamatan as  $kec) {
            echo "<option value='$kec->id'>$kec->name</option>";
        }
    }


}
