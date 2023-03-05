<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //method proses menambhakna produk ke keranajng
    public function addToCart(Request $request, $id){
        // menmambhakna data prodfuk berdasarkan id
        $product = Product::findOrFail($id);

        // jika data produk diskon bernilai null atau tidal ada
        if($product->product_discount == NULL){
            // jalankan berikut ini'
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->product_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            // tampilkan notif
            return response()->json(['success' => 'Produk Berhasil Di Tambahkan Ke Keranjang']);
        }else{
            // jika produk diskon ada maka tampilka
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->product_discount,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            // tampilkan notuif
            return response()->json(['success' => 'Produk Berhasil Di Tambahkan Ke Keranjang']);
        }

    }


    // method proses minicart
    public function AddMiniCart(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartSubtotal = Cart::subtotal();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartSubtotal' => round($cartSubtotal),
        ));
    }

    // functiom hapus mini cart keranjang
    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Produk Dihapus Dari Keranjang']);
    }
}
