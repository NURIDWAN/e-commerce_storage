@extends('backend.admin-master')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pengaturan Seo
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('admin.update')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $adminuser->id}}">
                                        <input type="hidden" name="old_image" value="{{ $adminuser->profile_photo_path}}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Nama<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="nama" placeholder="Nama admin" value="{{ $adminuser->nama}}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>Email<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="email" name="email" placeholder="Email" value="{{ $adminuser->email}}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>Nomor Telepon<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="phone" class="form-control" placeholder="Telepon" value="{{ $adminuser->phone}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Photo Profil<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="file" name="profile_photo_path" class="form-control"
                                                                    id="image">
                                                            </div>
                                                            <img id="showImage" src="{{ (!empty($adminuser->profile_photo_path))? url('upload/admin-images/'.$adminuser->profile_photo_path):url('upload/no_image.jpg')}}"
                                                                style="width: 100px; height:100px; margin-top:20px;"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="brand" value="1"
                                                            {{ $adminuser->brand == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_2">Merek</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_3" name="category" value="1"
                                                            {{ $adminuser->category == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_3">Kategory</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_4" name="product" value="1"
                                                            {{ $adminuser->product == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_4">Produk</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_5" name="slider" value="1"
                                                            {{ $adminuser->slider == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_5">Slider</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_6" name="coupon" value="1"
                                                            {{ $adminuser->coupon == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_6">kupon</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_7" name="shipping" value="1"
                                                            {{ $adminuser->shipping == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_7">Data Wilayah</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_8" name="orders" value="1"
                                                            {{ $adminuser->orders == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_8">Pesanan</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_9" name="cancel" value="1"
                                                            {{ $adminuser->cancel == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_9">Pembatalan Pesanan</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_10" name="return" value="1"
                                                            {{ $adminuser->return == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_10">Pengembalian Pesanan</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_11" name="stock" value="1"
                                                            {{ $adminuser->stock == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_11">Stok</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_12" name="review" value="1"
                                                            {{ $adminuser->review == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_12">Ulasan</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_13" name="adminrole" value="1"
                                                            {{ $adminuser->adminrole == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_13">Data Admin</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_14" name="alluser" value="1"
                                                            {{ $adminuser->alluser == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_14">Data Pelanggan</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_15" name="reports" value="1"
                                                            {{ $adminuser->reports == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_15">Laporan Pesanan</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_16" name="setting" value="1"
                                                            {{ $adminuser->setting == 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_16">Pengaturan</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-primary mb-5" value="ubah">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
