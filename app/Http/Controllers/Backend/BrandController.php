<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Arr;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    // method untuk menampilkan halaman merek
    public function BrandView(){

        // mnengbu;l data di database dan di tambungdi variabel bran
        // dan tampilkan data yg terbaru dngn latest
        $brands =  Brand::latest()->get();


        // menampilkan folder brands dan brand do fo;lder bakend
        return view('backend.brands.brand', compact('brands')) ;
    }

    // method proses untuk menambahkan data pd database
    public function BrandStore(Request $request){

        // validasi data
        $request->validate([
            'brand_name' => 'required',
            'brand_image' => 'required',
        ], [
            'brand_name.required' => 'Mohon Di isi Data Merek'
        ]);

        // variabel image yang berisiklaan gambar di request dari file yg namanya brandimage
        $image = $request->file('brand_image');

        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(200, 50)->save('upload/brands/'.$name_gen);

        $save_url = 'upload/brands/'. $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,

            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Merek Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        // toatr
        return redirect()->back()->with($notification);
    }



    // metghod menampilkan halaman edit
    public function BrandEdit($id){

        $brands = Brand::findOrFail($id);

        return view('backend.brands.brand-edit', compact('brands'));
    }

    // method untuyk proses update
    public function BrandUpdate(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('brand_image')) {
            unlink($old_image);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()). '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brands/'. $name_gen);
            $save_url ='upload/brands/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Data Berhasil Di Perbaharui',
                'alert-type' => 'info'
            );

            // toatr
            return redirect()->route('brand.view')->with($notification);
        }else{
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);
            $notification = array(
                'message' => 'Data Berhasil Di Perbaharui',
                'alert-type' => 'info'
            );

            return redirect()->route('brand.view')->with($notification);
        }
    }

    // method untuk menghapus data merek
    public function BrandDelete($id){

        $brands = Brand::findOrFail($id);
        $img = $brands->brand_image;
        @unlink($img);


        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Data Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }


}
