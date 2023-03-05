<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\District;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingAreaController extends Controller
{
    //method untuk menampilkan halaman province
    public function ProvinceView()
    {
        // mengambil model province kemudian parsing data dan urutkan dr terkecil ke terbear
        $responce = Http::get('http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');

        $data = json_decode($responce, true);

        $province = array_column($data,'name');



        // $provinces = Province::orderBy('id', 'ASC')->get();

        // dan araghkan halaman nya
        return view('backend.ship.province-view', compact('province'));
    }

    // mwthod utk proses tmabah
    public function ProvinceStore(Request $request)
    {
        // validasdi
        $request->validate([
            'province_name' => 'required',
        ], [
            'province_name.required' => 'Mohon Isi Nama Provinsi Terlebih Dahulu',
        ]);

        // insert dalam database
        Province::insert([
            'province_name' => $request->province_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Data Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // method untuk menampilkan halman edit
    public function ProvinceEdit($id)
    {
        $provinces = Province::findOrFail($id);

        return view('backend.ship.province-edit', compact('provinces'));
    }

    // mwthod untuk proses updta
    public function ProvinceUpdate(Request $request, $id)
    {
        Province::findOrFail($id)->update([
            'province_name' => $request->province_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Data Berhasil Di Edit',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.province')->with($notification);
    }

    // method untuk proses delete
    public function ProvinceDelete($id)
    {
        Province::findorFail($id)->delete();

        $notification = array(
            'message' => 'Data Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    // all method cities
    // method untuk menampilkan halaman city
    public function CityView()
    {
        $provinces = Province::orderby('id', 'ASC')->get();

        $cities = City::latest()->get();

        return view('backend.ship.city-view', compact('provinces', 'cities'));
    }

    // method untuk menambhakan data kota
    public function CityStore(Request $request)
    {
        // validasi
        $request->validate([
            'province_id' => 'required',
            'city_name' => 'required',
        ], [
            'province_id.required' => 'Mohon Pilih Province terlebih dahulu',
            'city_name.required' => 'mohon isi nama kota',
        ]);

        // proses insert pd database
        City::insert([
            'province_id' => $request->province_id,
            'city_name' => $request->city_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Data Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // method untuk menampilkan halamanedit
    public function CityEdit($id)
    {
        // mengambiil model province kemudian mengambil data kolom province_name
        $provinces = Province::orderBy('province_name', 'ASC')->get();

        // mnegambil data product berdasarkan id
        // parameted $id merupakam model city yang diabil datamya seuai degan id yg di url
        $cities = City::findOrFail($id);

        // memnagmbl dan mngarahkan ke halaman editny lalu parsing datanya
        return view('backend.ship.city-edit', compact('provinces', 'cities'));
    }

    // method untuk proses update
    public function CityUpdate(Request $request, $id)
    {
        City::findOrFail($id)->update([
            'province_id' => $request->province_id,
            'city_name' => $request->city_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Data Berhasil Di Ubah',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.city')->with($notification);
    }

    // method untuk proses hapus
    public function CityDelete($id)
    {
        City::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Data Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }


    // allmthod district
    // method untuk menampilkan halaman data tabel
    public function DistrictView()
    {
        $province = Province::orderBy('province_name', 'ASC')->get();
        $city = City::orderBy('city_name', 'ASC')->get();
        $district = District::with('province', 'city')->orderBy('id', 'ASC')->get();

        return view('backend.ship.district-view', compact('province', 'city', 'district'));
    }


    // method untuk proses update
    public function DistrictStore(Request $request)
    {
        // validasi
        $request->validate([
            'province_id' => 'required',
            'city_id' => 'required',
            'district_name' => 'required',
        ], [
            'province_id.required' => 'mohon pilih nama provinsi terlebih dahulu',
            'city_id.required' => 'mohon pilih nama kabupaten terlebih dahulu',
            'district_name.required' => 'mohon pilih nama kecamatan terlebih dahulu',
        ]);

        District::insert([
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Data berhasil di tambahkan',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // method unuk menampilkanhalaman edit
    public function DistrictEdit($id)
    {
        $province = Province::orderBy('province_name', 'ASC')->get();
        $city = City::orderBy('city_name', 'ASC')->get();
        $district = District::findOrFail($id);

        return view('backend.ship.district-edit', compact('province', 'city', 'district'));
    }


    // method untuk proses update
    public function DistrictUpdate(Request $request, $id)
    {
        District::findOrFail($id)->update([
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notif = array(
            'message' => 'Data berhasil di edit',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.district')->with($notif);
    }


    // method untk proses hapus data kecamatan
    public function DistrictDelete($id)
    {
        District::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Data berhasil di hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notif);
    }
}
