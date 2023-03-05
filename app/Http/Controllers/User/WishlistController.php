<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //function untuk halaman wishlist
    public function addToWishlist(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exist = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            if (!$exist) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);

                return response()->json(['success' => 'Produk Berhasil Ditambahkan Ke Wishlist']);
            } else {
                return response()->json(['error' => 'Produk Sudah Ditambahkan ']);
            }
        } else {
            return response()->json(['error' => 'Kamu Harus Login Terlebih Dahulu']);
        }
    }

    // method untuk menampilkan halaman wishlist
    public function WishlistView()
    {
        return view('frontend.mywishlist-view');
    }

    // method untuk mengambil data wishlist
    public function GetWishlistProduct(){
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($wishlist);
    }

    // proses hapus produk di wishlist
    public function RemoveWishlistProduct($id){
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Produk Berhasil DiHapus']);
    }
}
