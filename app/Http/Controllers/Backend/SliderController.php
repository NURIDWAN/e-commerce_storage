<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App\Models\Slider;

class SliderController extends Controller
{
    //method untuk menampilkan halaman kelola slider
    public function SliderView()
    {
        $sliders = Slider::latest()->get();
        return view('backend.sliders.slider-view', compact('sliders'));
    }

    // method untu  prosses tambah
    public function SliderStore(Request $request)
    {
        $request->validate([
            'slider_img' => 'required',
        ], [
            'slider_img.required' => 'Mohon Pilih Gambar Terdahulu',
        ]);

        // proses menyimpam gambar
        $image = $request->file('slider_img');
        $nama_slid = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(870, 370)->save('upload/sliders/'.$nama_slid);
        $save = 'upload/sliders/'.$nama_slid;

        // menerima array dr atribut dgn insert
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $save,
        ]);

        // notifikasi
        $notification = array(
            'message' => 'Data Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // metod untuk non aktifkan slider
    public function SliderNonaktif($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);

        // notifikasi
        $notification = array(
            'message' => 'Slider Non Aktif',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    // metod untuk aktifkan slider
    public function SliderAktif($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);

        // notifikasi
        $notification = array(
            'message' => 'Slider Aktif',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    // metod untuk menampilkan halaman edit
    public function SliderEdit($id)
    {
        // mengambil data slider berdasarkan id
        $sliders = Slider::findOrFail($id);

        // setelah di dapatkan presing arahkan pd halaman edit slider
        return view('backend.sliders.slider-edit', compact('sliders'));
    }

    // method untuk menampilkan proses edit
    public  function SliderUpdate(Request $request)
    {
        // mengambil data slider yg diambil dr name nya
        $slider_id = $request->id;
        $old_image = $request->old_image;

        // jika ada request file dgn gambarmaka jalankan
        if ($request->file('slider_img')) {
            // jalankan perintah berikut
            unlink($old_image);
            $image = $request->file('slider_img');
            $nama_slid = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(870, 370)->save('upload/sliders/'.$nama_slid);
            $save_slid = 'upload/sliders/' . $nama_slid;

            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $save_slid,
            ]);

            $notification = array(
                'message' => 'Slider Berhasil Di Edit',
                'alert-type' => 'info'
            );

            return redirect()->route('manage.slider')->with($notification);
        } else {
            // jika tidak ada request file dng nama sider_img maka
            Slider::findOrFail($slider_id)->update([
                'title' => $request->title,
                'description' => $request->description
            ]);

            $notification = array(
                'message' => 'Slider Berhasil Di Edit Tanpa Gambar',
                'alert-type' => 'info'
            );

            return redirect()->route('manage.slider')->with($notification);
        }
    }

    // method untuk proses delete slider
    public function SliderDelete($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_img;
        // unlink($img);
        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
