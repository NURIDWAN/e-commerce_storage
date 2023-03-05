<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
Use App\Models\SubCategory;
Use App\Models\SubSubCategory;
use Illuminate\Support\Arr;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){

        // memanggil model kategory kemudian menagmngbil data   kolom category_name
        $categories = Category::orderBy('category_name', 'ASC')->get();

        // memnaggil model subcategory kemudian mengurutkan data dr yang terbaru dengan method latest
        $subcategories = SubCategory::latest()->get();

        // memanggil view dengan nama subcategory.blade
        return view('backend.categories.subcategory', compact('categories', 'subcategories'));
    }

    // method untuk menmbhakl data category
    public function SubCategoryStore(Request $request){
        // validasi data
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ], [
            'category_id.required' => 'Mohon Pilih Salah Satu Sub Kategori',
            'subcategory_name.required' => 'Mohon diisi nama sub kategori',
        ]);

        // proses insert ke database
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name )),
        ]);

        $notification = array(
            'message' => 'Sub Kategori Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        // redirect halaman jika berhasil
        return redirect()->back()->with($notification);
    }



    // method untuk membuat halaman edit subcategory
    public function SubCategoryEdit($id) {

        // memanggil model kategori kemudian mengambil data kolom category_name
        $categories = Category::orderBy('category_name', 'ASC')->get();

        // mengambil data berdasrkan id
        $subcategories = SubCategory::findOrFail($id);

        return view('backend.categories.subcategory-edit', compact('categories', 'subcategories'));
    }

    // method untuk proses edit category
    public function SubCategoryUpdate(Request $request){

        // variabel subcategopry berisi  id yg di request dengan name id
        $subcategory_id = $request->id;

        // mengambill data berdasarkan id
        // kemudian melakukan proses update ke databasde
        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        $notification = array(
            'message' => 'Data Berhasil di perbarui',
            'alert-type' => 'info'
        );

        return redirect()->route('subcategory.view')->with($notification);

    }

    // method proses delete  category
    public function SubCategoryDelete($id){

        $subsubcategories = SubSubCategory::where('subcategory_id', '=', $id)->get();

        if (!$subsubcategories->isEmpty()) {
            $notification = array(
                'message' => 'Hapus dulu sub sub',
                'alert-type' => 'info'
            );
        }else {

            SubCategory::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Data Berhasil dihapus',
                'alert-type' => 'info'
            );
        }

        return redirect()->back()->with($notification);
    }


    // all method category
    public function SubSubCategoryView(){

        // memanggil model kategory kemudian menagmngbil data   kolom category_name
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $subcategories = SubCategory::orderBy('subcategory_name', 'ASC')->get();

        // memnaggil model subcategory kemudian mengurutkan data dr yang terbaru dengan method latest
        $subsubcategories = SubSubCategory::latest()->get();

        // memanggil view dengan nama subcategory.blade
        return view('backend.categories.subsubcategory', compact('categories', 'subcategories', 'subsubcategories'));
    }

    // mengambil meyhod dengan ajak yg subcategory
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);
    }


    // method untuk menmbhakl data category
    public function SubSubCategoryStore(Request $request){
        // validasi data
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name' => 'required',
        ], [
            'category_id.required' => 'Mohon Pilih Kategori',
            'subcategory_id.required' => 'Mohon Pilih Salah Satu Sub Kategori',
            'subsubcategory_name.required' => 'Mohon diisi nama sub sub kategori',
        ]);

        // proses insert ke database
        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' => strtolower(str_replace(' ', '-', $request->subsubcategory_name)),
        ]);

        $notification = array(
            'message' => 'Sub Sub Kategori Berhasil Di Tambahkan',
            'alert-type' => 'success'
        );

        // redirect halaman jika berhasil
        return redirect()->back()->with($notification);
    }


    // method untuk menampilkan halaman edit
    public function SubSubCategoryEdit($id){

        // memanggil model kategory kemudian menagmngbil data   kolom category_name
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $subcategories = SubCategory::orderBy('subcategory_name', 'ASC')->get();

        // memnaggil model subcategory kemudian mengurutkan data dr yang terbaru dengan method latest
        $subsubcategories = SubSubCategory::findOrFail($id);

        // memanggil view dengan nama subcategory.blade
        return view('backend.categories.subsubcategory-edit', compact('categories', 'subcategories', 'subsubcategories'));
    }

    // method untuk proses edit
    public function SubSubCategoryUpdate(Request $request){

        $subsubcategory_id = $request->id;


        SubSubCategory::findOrFail($subsubcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name,
            'subsubcategory_slug' => strtolower(str_replace('', '-', $request->subsubcategory_name)),
        ]);

        $notification = array(
            'message' => 'Data Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->route('subsubcategory.view')->with($notification);
    }

    // method untuk proses hapus data
    public function SubSubCategoryDelete($id){

        SubSubCategory::findOrFail($id)->delete();

        $notification = Array(
            'message' => 'Data Berhasil Di Hapus',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }


    // method mengambil subsub category dari ajax
     // mengambil meyhod dengan ajak yg subcategory
     public function GetSubSubCategory($subcategory_id){
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name', 'ASC')->get();
        return json_encode($subsubcat);
    }
}
