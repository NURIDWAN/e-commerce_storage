<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
Use App\Models\Brand;
Use App\Models\Category;
Use App\Models\Product;
Use App\Models\ProductGallery;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use ParagonIE\ConstantTime\Hex;

class ProductController extends Controller
{
    // method untuk menampilkan halaman produk
    public function AddProduct(){

        // mengambil data brand dr database kemudian di tambung dlm variable
        // dan tampilkan datanya dr yg terbaru
        $brands = Brand::latest()->get();

        // mengambil data kategori dan ditambung dalam variable
        // tampilkan dr yang terbaru
        $categories = Category::latest()->get();

        // memanggil halaman produk yang ada pd backend/product
        // kemudian parsding data menggunakan compact

        return view('backend.products.product-add', compact('brands', 'categories'));
    }

    // method proses tambah data
    public function ProductStore(Request $request){
        // proses penyimpanan gambar thumbnail


        // varianel image berisikan gambar yg di request namenya product_thumbnail
        $image = $request->file('product_thumbnail');

        // buat code unik atau acank untuk nama gambar
        $nama_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        // resize ukuran gambar
        Image::make($image)->resize(500,500)->save('upload/products/thumbnail/'.$nama_gen);
        $save_url = ('upload/products/thumbnail/'.$nama_gen);

        // method insert
        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,

            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'product_weight' => $request->product_weight,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_short_desc' => $request->product_short_desc,
            'product_long_desc' => $request->product_long_desc,
            'product_promo' => $request->product_promo,
            'new_product' => $request->new_product,
            'new_arrival' => $request->new_arrival,
            'best_seller' => $request->best_seller,

            'product_link_lazada' => $request->product_link_lazada,
            'product_link_shopee' => $request->product_link_shopee,
            'product_link_tokopedia' => $request->product_link_tokopedia,

            'product_thumbnail' => $save_url,
            'product_status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // proses simpan data produk gallery

        // vriable images berisikan gambar yg di request dr name product_gallery
        $images = $request->file('product_gallery');
        foreach ($images as $img ){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(500,500)->save('upload/products/product-gallery/'.$make_name);
            $saveurl = 'upload/products/product-gallery/'.$make_name;

            ProductGallery::insert([
                'product_id' => $product_id,
                'photo_name' => $saveurl,
                'created_at' => Carbon::now(),
            ]);
        }

        // notifikasi
        $notification = array(
            'message' => 'Product Berhasil di tambahkan',
            'alert-type' => 'success'
        );

        // redirect halaman jika berhasil
        return redirect()->route('manage.product')->with($notification);
    }

    // method untuk menampilkan halaman kelola produk
    public function ManageProduct(){
        $products = Product::latest()->get();
        foreach ($products as $key => $value) {
            if ($value->product_qty <= 0) {
                Product::findOrFail($value->id)->update(['product_status' => 0]);
            }elseif($value->product_qty > 0) {
                return view('backend.products.product-view', compact('products'));
            }
        }

    }

    // method untuk mengaktifkan produk di frontend
    public function ProductInactive($id){
        Product::findOrFail($id)->update(['product_status' => 0]);
        $notification = array(
            'message' => 'Product Non Aktif',
            'alert-type' => 'success'
        );

        // redirect halaman jika berhasil
        return redirect()->back()->with($notification);
    }

    // method active
    public function ProductActive($id){
        Product::findOrFail($id)->update(['product_status' => 1]);
        $notification = array(
            'message' => 'Product Aktif',
            'alert-type' => 'success'
        );

        // redirect halaman jika berhasil
        return redirect()->back()->with($notification);
    }

    // method untuk menampilkan halaman edit
    public function ProductEdit($id){
        // mengambil data product gallery berdasarkan id
        //  parameter $id merupakan model product galery yg diambil dr url id
    $productGalleries = ProductGallery::where('product_id',$id)->get();
    $brands = Brand::latest()->get();
    $categories = Category::latest()->get();
    $subcategories = SubCategory::latest()->get();
    $subsubcategories = SubSubCategory::latest()->get();

    // mengambil data product berdasarka id
    $products = Product::findOrFail($id);
    return view('backend.products.product-edit', compact('productGalleries', 'brands', 'categories', 'subcategories', 'subsubcategories', 'products'));
    }

    // method untuk proses update
    public function ProductUpdate(Request $request){
        // variabel_product_id berisi id yg direquest
        $product_id = $request->id;

        // mengambuik data berdsasarkan $Product_id
        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,

            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'product_weight' => $request->product_weight,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_short_desc' => $request->product_short_desc,
            'product_long_desc' => $request->product_long_desc,
            'product_promo' => $request->product_promo,
            'new_product' => $request->new_product,
            'new_arrival' => $request->new_arrival,
            'best_seller' => $request->best_seller,

            'product_link_lazada' => $request->product_link_lazada,
            'product_link_shopee' => $request->product_link_shopee,
            'product_link_tokopedia' => $request->product_link_tokopedia,

            'product_status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Berhasil Di perbarui',
            'alert-type' => 'info'
        );

        // redirect halaman jika berhasil
        return redirect()->route('manage.product')->with($notification);

    }


    // method untuk proses update gambar thumbnail
    public function ProductImageUpdate(Request $request){

        // mengambil data produk yg diu request dr name id dan old_img
        $product_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);

        $image = $request->file('product_thumbnail');
        $nama_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(500,500)->save('upload/products/thumbnail/'.$nama_gen);
        $save_url = 'upload/products/thumbnail/'.$nama_gen;

        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Foto Product Berhasil Di Perbarui',
            'alert-type' => 'info'
        );

        // redirect halaman jika berhasil
        return redirect()->route('manage.product')->with($notification);
    }

    // method untuk proses update gallery
    public function ProductGalleryUpdate(Request $request){

        // mengambil data produk yg diu request dr name id dan old_img
        $imgs = $request->product_gallery;

        // menghambil data kolom photo name berdasarkan id
        foreach ($imgs as $id => $img) {
            $imgDel = ProductGallery::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(500,500)->save('upload/products/product-gallery/'.$make_name);
            $upload = 'upload/products/product-gallery/'.$make_name;

            ProductGallery::where('id', $id)->update([
                'photo_name' => $upload,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Galery Product Berhasil Di Perbarui',
            'alert-type' => 'info'
        );

        // redirect halaman jika berhasil
        return redirect()->back()->with($notification);
    }

    // method untuk proses hapus gambar gallery image
    public function ProductGalleryDelete($id){
        $old_image = ProductGallery::findOrFail($id);
        unlink($old_image->photo_name);
        ProductGallery::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Foto Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        // redirect halaman jika berhasil
        return redirect()->back()->with($notification);
    }

    // method untuk proses hapus product
    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = ProductGallery::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            ProductGallery::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Produk Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        // redirect halaman jika berhasil
        return redirect()->back()->with($notification);
    }

    public function ProductStock()
    {
        $products = Product::latest()->get();
        return view('backend.products.product-stock', compact('products'));
    }
}
