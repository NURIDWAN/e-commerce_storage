<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{

    // method menampilkan halaman user profile
    public function UserProfile()
    {
        $id = Auth::user()->id; //ambil id user yang login dan tampung di variable $id
        $user = User::find($id); // temukan id user yg login dan tampung data user di variabel user
        return view('frontend.profile.user-profile-view', compact('user'));
    }

    // method menampilkan halaman edit password
    public function UserChangePassword()
    {
        $id = Auth::user()->id; //ambil id user yang login dan tampung di variable $id
        $user = User::find($id); // temukan id user yg login dan tampung data user di variabel user
        return view('frontend.profile.user-change-password', compact('user'));
    }


    // method untuk proses logout
    public function UserLogout()
    {
        Auth::logout();
        return Redirect()->route('login'); // redirect setelah berhasil logout
    }

    //    method untuk mengubah [profile user]
    public function UserProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user-images/' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user-images'), $filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();

        //    toastr notifiklasi
        $notification = array(
            'message' => 'Data Berhasil Di Perbaharui',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }


    //    method untuk mengubah password user
    public function UserPasswordUpdate(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        // jika password lama sesuaidata base
        if (Hash::check($request->oldpassword, $hashedPassword)) {

            // temukan id user yg login
            $user = User::find(Auth::id());

            // kemuydian ubah password yang baru di inputkan
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            // jika berhasil berhasil diarahkan ke login
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }




    // method untuk proses logout
    public function index()
    {
        // memnamil model slider kemudian ambil data slider yg aktiv dng true 1
        // lalu batas tampilkan dengan; perintah limit 3
        $sliders = Slider::where('status', 1)->orderBy('id', 'ASC')->limit(3)->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Product::where('product_status', 1)->orderBy('id', 'ASC')->limit(10)->get();

        // memanggil model produc kemudian ambil data produk dengan kolom product_status berisi 1 dan kolom new_product berisi 1
        $new_product = Product::where('product_status', 1)->where('new_product', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $new_arrival = Product::where('product_status', 1)->where('new_arrival', 1)->orderby('id', 'DESC')->limit(6)->get();

        $best_seller = Product::where('product_status', 1)->where('best_seller', 1)->orderBy('id', 'ASC')->limit(6)->get();

        $product_promo = Product::where('product_status', 1)->where('product_promo', 1)->where('product_discount', '!=', NULL)->orderBy('id', 'DESC')->limit(4)->get();

        return view('frontend.home', compact('categories', 'products', 'sliders', 'new_product', 'new_arrival', 'best_seller', 'product_promo'));
    }

    // method untuk menampilkan halaman detailproduk
    public function TagWiseProduct($tag)
    {
        $products = Product::where('product_status', 1)->where('product_tags', $tag)->orderBy('id', 'DESC')->paginate(6);

        $categories = Category::orderBy('category_name', 'ASC')->get();

        return view('frontend.product.product-tags-view', compact('products', 'categories'));
    }

    // method untuk subcategory
    public function SubCatWiseProduct(Request $request, $subcat_id, $slug)
    {
        $products = Product::where('product_status', 1)->where('subcategory_id', $subcat_id)->orderBy('id', 'DESC')->paginate(6);

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadsubcat = SubCategory::with(['category'])->where('id', $subcat_id)->get();

        return view('frontend.product.subcategory-view', compact('products', 'categories', 'breadsubcat'));
    }


    // method untk subsubcategory
    public function SubSubCatWiseProduct(Request $request, $subsubcat_id, $slug)
    {
        $products = Product::where('product_status', 1)->where('subsubcategory_id', $subsubcat_id)->orderBy('id', 'ASC')->paginate(5);

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadsubsubcat = SubSubCategory::with(['category', 'subcategory'])->where('id', $subsubcat_id)->get();

        return view('frontend.product.subsubcategory-view', compact('products', 'categories', 'breadsubsubcat'));
    }


    // method untuk proses cari dan menampilkannya
    public function search(Request $request)
    {
        $request->validate(['search' => 'required']);

        $itemcari = $request->search;

        $categories = Category::orderBy('category_name', 'ASC')->get();

        // cari data produk yg memiliki data yg sama dngn nama yg dicari dari $itemcari
        $products = Product::where('product_name', 'LIKE', "%$itemcari%")->orderBy('id', 'DESC')->paginate(6);

        return view('frontend.product.search', compact('categories', 'products'));
    }



    // all method front end produk
    // product detail page url
    public function ProductDetails($id, $slug)
    {
        // memanggil data produk berdasarkan id
        // parameter $id merupakan id ygg di dapat dr url
        // parameter slug meyesuaikan dr product slug dr url
        $products = Product::findOrFail($id);

        $color = $products->product_color;
        $product_color = explode(',', $color);

        $size = $products->product_size;
        $product_size = explode(',', $size);

        $product_galleries = ProductGallery::where('product_id', $id)->get();

        $cat_id = $products->category_id;
        $related_product = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->get();

        // kemudianarahkan pd halamanyg di tuju
        return view('frontend.product.product-details', compact('products', 'product_color', 'product_size', 'product_galleries', 'related_product'));
    }


    // method untuk menampilkan data produk menggunakan ajx
    public function ProductViewAjax($id)
    {

        $product = Product::with('category', 'brand')->findOrFail($id);

        $color = $product->product_color;
        $product_color = (explode(',', $color));

        $size = $product->product_size;
        $product_size = (explode(',', $size));

        return response()->json(array(
            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }
}
