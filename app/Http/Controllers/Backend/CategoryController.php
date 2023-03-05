<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    // method untuk menampilkan halaman kategori
    public function CategoryView()
    {

        // memanggil model kategori kemudian mengurtkan nya dari yg terbaru dengan latest
        $categories = Category::latest()->get();

        // memanggil categories blade dengan return
        // parsing data kategori menggunakan compact
        return view('backend.categories.category', compact('categories'));
    }

    // method proses simpandata
    public function CategoryStore(Request $request)
    {
        // validasi data
        $request->validate([
            'category_name' => 'required',
            'category_icon' => 'required',
        ], [
            'category_name.required' => 'Mohon di isi data kategori',
            'category_icon.required' => 'Mohon diisi icon terlebih dahulu',
        ]);

        // proses insert data ke database
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_icon' => $request->category_icon,
        ]);

        // toastr notification
        $notification = array(
            'message' => 'Kategori Berhasil di tambahkan',
            'alert-type' => 'success'
        );

        // redirect halaman kembali jika berhasil
        return redirect()->back()->with($notification);
    }

    // mthod untuk memampilkan halaman edit
    public function CategoryEdit($id)
    {

        // mengambil data kategori berdaarkan id
        // paraeter $id meupakan model kategori yang diambil datanya sesuai degan url
        $categories = Category::FindOrFail($id);

        // mengambil viw dengan category-editblade
        // parsing data kedalam view menggunkanhelper compact

        return view('backend.categories.category-edit', compact('categories'));
    }

    // method untukproses update data kategori
    public function CategoryUpdate(Request $request)
    {

        $category_id = $request->id;

        // mengambil data berdasarkan $kategori_id yang diambil
        // kemudian melalukan proses update ke database dengan method update
        Category::FindOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_icon' => $request->category_icon,
        ]);

        // membuat notifiion berhasil edit
        $notification = array(
            'message' => 'Data Kategori Berhsil Di Update',
            'alert-type' => 'info'
        );

        return redirect()->route('category.view')->with($notification);
    }

    // method untukproses hapus
    public function CategoryDelete($id)
    {


            $subcategory = SubCategory::where('category_id', '=', $id)->get();

            if (!$subcategory->isEmpty()) {

                $notification = array(
                'message' => 'hapus dulu subcategory',
                'alert-type' => 'error'
                );
            }else{
            // data diambil berdasarkan id menggunakan method finorfail
            // setelah data ditemukan gunakan method delete untuk proses
            Category::FindOrFail($id)->delete();
            // membuat notifiion berhasil hapus
            $notification = array(
                'message' => 'Data Kategori Berhsil Di Hapus',
                'alert-type' => 'info'
                );
            }

            return redirect()->back()->with($notification);
    }
}
