@extends('backend.admin-master')
@section('content')
<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <div class="box bt-3 border-info">
                    < <div class="box-body">
                        <form method="post" action="{{ route('product.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $products->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Pilih Merek <span class="text-danger"> *</span></h5>
                                            <div class="controls">
                                                <select class="form-control" name="brand_id" id="">
                                                    <option selected disabled>Pilih Brand</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                                @error('brand_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Kategori <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <select class="form-control" name="category_id" id="">
                                                        <option selected disabled>Pilih Kategori</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category->id == $products->category_id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Sub Kategori <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <select class="form-control" name="subcategory_id" id="">
                                                        <option selected disabled>Pilih Sub Kategori</option>
                                                        @foreach($subcategories as $subcat)
                                                        <option value="{{ $subcat->id }}"
                                                            {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>
                                                            {{ $subcat->subcategory_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Sub Sub Kategori <span class="text-danger"> *</span></h5>
                                                <div class="controls">
                                                    <select class="form-control" name="subsubcategory_id" id="">
                                                        <option selected disabled>Pilih Sub Sub Kategori</option>
                                                        @foreach($subsubcategories as $subsubcat)
                                                        <option value="{{ $subsubcat->id }}"
                                                            {{ $subsubcat->id == $products->subsubcategory_id ? 'selected' : '' }}>
                                                            {{ $subsubcat->subsubcategory_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    @error('subsubcategory_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Nama Produk <span class="text-danger"> *</span></h5>
                                            <div class="controls"> <input type="text" name="product_name"
                                                    value="{{ $products->product_name }}" class="form-control">
                                                @error('product_name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Berat Produk <span class="text-danger"> *</span></h5>
                                                <div class="controls"> <input type="text" name="product_weight"
                                                        placeholder="Berat Produk"
                                                        value="{{ $products->product_weight }}" class="form-control">
                                                    @error('product_weight')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <h5>Kode Produk <span class="text-danger"> *</span></h5>
                                            <div class="controls"> <input type="text" name="product_code"
                                                    placeholder="Barcode" value="{{ $products->product_code }}"
                                                    class="form-control">
                                                @error('product_code')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Stok Produk <span class="text-danger"> *</span></h5>
                                                <div class="controls"> <input type="text" name="product_qty"
                                                        placeholder="Jumlah Stok Produk"
                                                        value="{{ $products->product_qty }}" class="form-control">
                                                    @error('product_qty')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <h5>Ukuran Produk <span class="text-danger"> *</span></h5>
                                            <div class="controls"> <input type="text" name="product_size"
                                                    class="form-control" , value="{{ $products->product_size }}"
                                                    data-role="tagsinput" required="">
                                                @error('product_size')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Warna Produk <span class="text-danger"> *</span></h5>
                                                <div class="controls"> <input type="text" name="product_color"
                                                        class="form-control" , value="{{ $products->product_color }}"
                                                        data-role="tagsinput" required=""> @error('product_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Tag Produk <span class="text-danger"> *</span></h5>
                                            <div class="controls"> <input type="text" name="product_tags"
                                                    class="form-control" value="{{ $products->product_tags }}"
                                                    data-role="tagsinput" required="">
                                                @error('product_tags')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <h5>Harga Produk <span class="text-danger"> *</span></h5>
                                            <div class="controls"> <input type="text" name="product_price"
                                                    placeholder="Harga Produk" value="{{ $products->product_price }}"
                                                    class="form-control" required="">
                                                @error('product_price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Harga Diskon <span class="text-danger">*</span></h5>
                                                <div class="controls"> <input type="text" name="product_discount"
                                                        class="form-control" id="harga" placeholder="Harga Discount"
                                                        value="{{ $products->product_discount }}">
                                                    @error('product_discount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Link Lazada <span class="text-danger">*</span></h5>
                                                <div class="controls"> <input type="text" name="product_link_lazada"
                                                        class="form-control" id="link" placeholder="Link Lazada"
                                                        value="{{ $products->product_link_lazada }}">
                                                    @error('product_link_lazada')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Link Shopee <span class="text-danger">*</span></h5>
                                                <div class="controls"> <input type="text" name="product_link_shopee"
                                                        class="form-control" id="link" placeholder="Link Shopee"
                                                        value="{{ $products->product_link_shopee }}">
                                                    @error('product_link_shopee')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>Link Tokopedia <span class="text-danger">*</span></h5>
                                                <div class="controls"> <input type="text" name="product_link_tokopedia"
                                                        class="form-control" id="link" placeholder="Link Tokopedia"
                                                        value="{{ $products->product_link_tokopedia }}">
                                                    @error('product_link_tokopedia')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <h5>Deskripsi Pendek (Short) <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea name="product_short_desc" id="textarea" class="form-control" ,
                                                    required placeholder="Deskripsi Pendek">
                                                {!! $products->product_short_desc !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <h5>Deskripsi Panjang (Long) <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <textarea id="editor1" name="product_long_desc" rows="10" cols="80"
                                                    required=""
                                                    placeholder="Deskripsi Panjang">{!! $products->product_long_desc !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="controls">
                                                <fieldset> <input type="checkbox" id="checkbox_2" name="product_promo"
                                                        value="1" {{ $products->product_promo == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_2">Promo</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_3" name="new_product" ,
                                                        value="1" {{ $products->new_product == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_3">Produk Baru</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_4" name="new_arrival" ,
                                                        value="1" {{ $products->new_arrival == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_4">Baru Datang</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_5" name="best_seller" value="1"
                                                        {{ $products->best_seller == 1 ? 'checked' : '' }}>
                                                    <label for="checkbox_5">Best Sellers</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-md btn-primary mb-5" value="Perbarui Produk">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <form method="post" action="{{ route('product.image.update') }}" enctype="multipart/form-data">
                @csrf
                {{-- mengambil data produk berdasarkan id --}}
                <input type="hidden" name="id" value="{{ $products->id }}">
                <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">
                <div class="box bt-3 border-info">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Produk (Thumbnail) <span class="text-danger"> *</span></h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="controls">
                                        <input type="file" name="product_thumbnail" class="form-control" id="gambar"
                                            required="" onchange="ThumbUrl(this)">
                                        @error('product_thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img src="" id="mainThmb">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <img src="{{ asset($products->product_thumbnail) }}"
                                        style="height: 175px width: 175px;">
                                </div>
                                <div class="col-md-6">
                                    <img src="" alt="" id="Thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-md btn-primary mb-5" value="Perbaharui Foto Produk">
                        </div>
                    </div>
                </div>
            </form>


            <form method="post" action="{{ route('product.gallery.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="box bt-3 border-info">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Produk Galeri <span class="text-danger"> *</span></h5>
                                </div>
                            </div>
                            <div class="row mt-2">
                                @foreach($productGalleries as $prodgal)
                                <div class="col-md-6 mt-2">
                                    <img src="{{ asset($prodgal->photo_name) }}" style="height: 175px width: 175px;">
                                    <div class="mx-auto text-center mt-2 mb-2">
                                        <a href="{{ route('product.gallery.delete', $prodgal->id) }}" class="btn btn-sm btn-danger" id="delete" title="delete data">Hapus
                                            Foto</a>
                                    </div>
                                    <div class="controls">
                                        <input type="file" name="product_gallery[{{ $prodgal->id }}]" for="galeri"
                                            class="form-control" id="prodgal" multiple for="prodgal">
                                        @error('product_gallery')
                                        <span class="text danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-md btn-primary mb-5" value="Perbaharui Galeri Produk">
                        </div>
                    </div>
                </div>
            </form>
        </div>
</div>
</section>
</div>


{{-- ajax sub katregori dan subsub kategori --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subsubcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name + '</option>'
                            );
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

        // ajx subsub kategori
        $('select[name="subcategory_id"]').on('change', function () {
            var subcategory_id = $(this).val();
            if (subcategory_id) {
                $.ajax({
                    url: "{{ url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="subsubcategory_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="subsubcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subsubcategory_name + '</option>'
                            );
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

{{-- ajax foto thumbnail --}}
<script type="text/javascript">
    function ThumbUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#Thumb').attr('src', e.target.result).width(150).height(150);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

{{-- ajax gelery foto --}}
<script type="text/javascript">
    $(document).ready(function () {
        $('#multiImg').on('change', function () {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var data = $(this)[0].files;

                $.each(data, function (index, file) {
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                        var fRead = new FileReader();
                        fRead.onload = (function (file) {
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                    e.target.result).width(75).height(75);
                                $('#preview_img').append(img);
                            };
                        })(file);
                        fRead.readAsDataURL(file);
                    }
                });

            } else {
                alert("Your browser doesn't support File Api");
            }
        });
    });
</script>

@endsection
