@extends('frontend.main-master')
@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li class='active'>Detail Produk</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-12'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">
                                    <div id="owl-single-product">
                                        @foreach ($product_galleries as $prodgal)
                                            <div class="single-product-gallery-item" id="slide{{ $prodgal->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery"
                                                    href="{{ asset($prodgal->photo_name) }}">
                                                    <img class="img-responsive" alt=""
                                                        src="{{ asset($prodgal->photo_name) }}"
                                                        data-echo="{{ asset($prodgal->photo_name) }}" />
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach
                                    </div><!-- /.single-product-gallery-slider -->
                                    <div class="single-product-gallery-thumbs gallery-thumbs">
                                        <div id="owl-single-product-thumbnails">

                                            @foreach ($product_galleries as $prodgal)
                                                <div class="item">
                                                    <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                        data-slide="1" href="#slide{{ $prodgal->id }}">
                                                        <img class="img-responsive" width="85" alt=""
                                                            src="{{ asset($prodgal->photo_name) }}"
                                                            data-echo="{{ asset($prodgal->photo_name) }}" />
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div><!-- /#owl-single-product-thumbnails -->
                                    </div><!-- /.gallery-thumbs -->
                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->

                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name" id="pname">{{ $products->product_name }}</h1>

                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            @php
                                                $reviews = App\Models\Review::where('product_id', $products->id)
                                                ->max('rating');
                                            @endphp
                                            <div class="col-sm-3">
                                                @if ($reviews == 0)
                                                @elseif ($reviews == 1)
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                @elseif ($reviews == 2)
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                @elseif ($reviews == 3)
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                @elseif ($reviews == 4)
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star"></span>
                                                @elseif ($reviews == 5)
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                    <span class="fa fa-star checked"
                                                        style="color: yellow"></span>
                                                @endif
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="reviews">
                                                    <a href="#" class="lnk"></a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <div class="stock-box">
                                                    <span class="label">Stok : {{ $products->product_qty }}</span>

                                                </div>
                                            </div>
                                            <div class="col-sm-9">

                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        {{ $products->product_short_desc }}
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($products->product_discount == null)
                                                        <span class="price">
                                                            Rp{{ number_format($products->product_price, 0, '', '.') }}
                                                        </span>
                                                    @else
                                                        <span class="price">
                                                            Rp{{ number_format($products->product_discount, 0, '', '.') }}
                                                        </span>
                                                        <span class="price-strike">
                                                            Rp{{ number_format($products->product_price, 0, '', '.') }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    @if ($products->product_link_lazada)
                                                        <a href="{{ $products->product_link_lazada }}"
                                                            style="padding-right: 20px"><img width="50px"
                                                                src="{{ url('frontend/assets/images/ecommerce/lazada.png') }}"
                                                                alt=""></a>
                                                    @endif
                                                    @if ($products->product_link_tokopedia)
                                                        <a href="{{ $products->product_link_tokopedia }}"
                                                            style="padding-right: 20px"><img width="50px"
                                                                src="{{ url('frontend/assets/images/ecommerce/tokopedia.png') }}"
                                                                alt=""></a>
                                                    @endif
                                                    @if ($products->product_link_shopee)
                                                        <a href="{{ $products->product_link_shopee }}"
                                                            style="padding-right: 20px"><img width="50px"
                                                                src="{{ url('frontend/assets/images/ecommerce/shopee.png') }}"
                                                                alt=""></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">

                                                @if ($products->product_color == null)
                                                @else
                                                    <label class="info-title control-label">Pilih Warna
                                                        <span></span></label>
                                                    <select class="form-control unicase-form-control selectpicker"
                                                        style="display: none;" name="" id="color">
                                                        <option selected="" disabled="">--Pilih Warna--</option>
                                                        @foreach ($product_color as $color)
                                                            <option value="{{ $color }}">{{ ucwords($color) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Pilih Ukuran <span></span></label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                    style="display: none;" name="" id="size">
                                                    <option selected="" disabled="">--Pilih Ukuran--</option>
                                                    @foreach ($product_size as $size)
                                                        <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <span class="label">Jumlah :</span>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <input type="number" class="form-control" id="qty"
                                                            value="1" min="1">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-7">
                                                <input type="hidden" id="product_id" value="{{ $products->id }}">
                                                <button type="submit" class="btn btn-primary mb-2"
                                                    onclick="addToCart()">Keranjang</button>
                                            </div>

                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->
                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">Deskripsi</a></li>
                                    <li><a data-toggle="tab" href="#review">Penilaian Dan Ulasan</a></li>
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">
                                <div class="tab-content">
                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">{!! $products->product_long_desc !!}</p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">
                                            <div class="product-reviews">
                                                <h4 class="title">Ulasan Pembeli</h4>
                                                @php
                                                    $reviews = App\Models\Review::where('product_id', $products->id)
                                                        ->latest()
                                                        ->limit(5)
                                                        ->get();
                                                @endphp
                                                <div class="reviews">
                                                    @foreach ($reviews as $item)
                                                        @if ($item->status == 0)
                                                        @else
                                                            <div class="review">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <img style="border-radius: 50%"
                                                                            src="{{ !empty($item->user->profile_photo_path) ? url('upload/user-images/' . $item->user->profile_photo_path) : url('upload/no_image.jpg') }}"
                                                                            width="50px" height="50px">
                                                                        <b>{{ $item->user->name }}</b>

                                                                        @if ($item->rating == 0)
                                                                        @elseif ($item->rating == 1)
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        @elseif ($item->rating == 2)
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        @elseif ($item->rating == 3)
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        @elseif ($item->rating == 4)
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star"></span>
                                                                        @elseif ($item->rating == 5)
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                            <span class="fa fa-star checked"
                                                                                style="color: yellow"></span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="review-title">
                                                                    <span class="date"><i class="fa fa-calendar"></i>
                                                                        <span>{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span></span>
                                                                </div>
                                                                <div class="text">{{ $item->comment }}</div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->

                                            <div class="product-add-review">
                                                <h4 class="title">Beri Penilaian Dan Ulasan</h4>
                                                <div class="review-form">
                                                    @guest
                                                        <p><b>Untuk menambah Ulasan. Anda harus login terlebih dahulu
                                                                <a href="{{ route('login') }}">Login disini</a>
                                                            </b></p>
                                                    @else
                                                        <div class="form-container">
                                                            <form role="form" class="cnt-form"
                                                                action="{{ route('review.store') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $products->id }}">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="cell-label">&nbsp;</th>
                                                                                <th>1 stars</th>
                                                                                <th>2 stars</th>
                                                                                <th>3 stars</th>
                                                                                <th>4 stars</th>
                                                                                <th>5 stars</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="cell-label">Rating</td>
                                                                                <td><input type="radio" name="quality"
                                                                                        class="radio" value="1"></td>
                                                                                <td><input type="radio" name="quality"
                                                                                        class="radio" value="2"></td>
                                                                                <td><input type="radio" name="quality"
                                                                                        class="radio" value="3"></td>
                                                                                <td><input type="radio" name="quality"
                                                                                        class="radio" value="4"></td>
                                                                                <td><input type="radio" name="quality"
                                                                                        class="radio" value="5"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table><!-- /.table .table-bordered -->
                                                                </div><!-- /.table-responsive -->

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputReview">Tulis Ulasan <span
                                                                                    class="astk">*</span></label>
                                                                            <textarea class="form-control txt txt-review" name="comment" id="exampleInputReview" rows="4"
                                                                                placeholder="Bagaimana pengalaman anda setelah menggunakan produk ini"></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button class="btn btn-primary btn-upper"
                                                                        type="submit">Kirim Ulasan</button>
                                                                </div><!-- /.action -->
                                                            </form><!-- /.cnt-form -->
                                                        </div><!-- /.form-container -->
                                                    @endguest
                                                </div><!-- /.review-form -->
                                            </div><!-- /.product-add-review -->
                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->
                </div><!-- /.col -->

                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">

                        {{-- produk promo --}}
                        @include('frontend.templates.product-promo')

                    </div>
                </div><!-- /.sidebar -->

                <div class="col-md-9">
                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">Product Terkait</h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                            @forelse ($related_product as $product)
                                {{-- jika ada tampilkan sintakberikut --}}

                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="">
                                                        <img src="{{ asset($product->product_thumbnail) }}"
                                                            alt=""></a>
                                                </div><!-- /.image -->

                                                @php
                                                    $amount = $product->product_price - $product->product_discount;
                                                    $discount = ($amount / $product->product_price) * 100;
                                                @endphp

                                                @if ($product->product_discount != null)
                                                    <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                                @else
                                                @endif

                                            </div><!-- /.product-image -->

                                            <div class="product-info text-left">
                                                <h3 class="name"><a href="detail.html">{{ $product->product_name }}</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>

                                                @if ($product->product_discount == null)
                                                    <div class="product-price">
                                                        <span class="price">
                                                            Rp{{ number_format($product->product_price, 0, '', '.') }}
                                                        </span>
                                                    @else
                                                        <div class="product-price">
                                                            <span class="price">
                                                                Rp{{ number_format($product->product_discount, 0, '', '.') }}
                                                            </span>
                                                            <span
                                                                class="price-before-discount">Rp{{ number_format($product->product_price, 0, '', '.') }}</span>
                                                @endif
                                            </div><!-- /.product-price -->

                                        </div><!-- /.product-info -->

                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown"
                                                            type="button">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                        <button class="btn btn-primary cart-btn"
                                                            type="button">Keranjang</button>
                                                    </li>
                                                    <li class="lnk">
                                                        <a class="add-to-cart"
                                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                            title="Detail Produk">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.action -->
                                        </div><!-- /.cart -->
                                    </div><!-- /.product -->
                                </div><!-- /.products -->
                        </div><!-- /.item -->
                    @empty
                        {{-- jika tidak ada tampilkan --}}
                        <h5 class="text-danger">Produk Tidak Ditemukan</h5>
                        @endforelse
                </div><!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
            </div>
            <div class="clearfix"></div>
        </div><!-- /.row -->

        {{-- brand --}}
        @include('frontend.templates.brands')

    </div><!-- /container -->
    </div><!-- /.bodycontent -->


    <script>
        // menambhakn data produk ke keranjang
        function addToCart() {
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#qty').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    color: color,
                    size: size,
                    quantity: quantity,
                    product_name: product_name
                },
                url: '/cart/data/store/' + id,
                success: function(data) {


                    //notification
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })

                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                }
            })
        }
    </script>
@endsection
