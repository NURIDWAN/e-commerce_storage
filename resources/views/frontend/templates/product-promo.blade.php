@php
$product_promo = App\Models\Product::where('product_promo', 1)->where('product_discount', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();
@endphp

<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Produk Promo</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach ($product_promo as $product)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image">
                        <img src="{{ asset($product->product_thumbnail) }}" alt="">
                    </div>

                    {{-- sintak untuk menghitung diskon --}}
                    @php
                    $amount = $product->product_price - $product->product_discount;
                    $discount = ($amount/$product->product_price) * 100;
                    @endphp

                    <div class="sale-offer-tag">
                        <span>{{ round($discount) }} %</span>
                    </div>

                </div>
                <!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name">
                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a>
                    </h3>
                    <div class="rating rateit-small"></div>


                    {{-- jika produk diuskon sama dng null atau tdk ada --}}
                    @if($product->product_discount == NULL)
                    <div class="product-price">
                        <span class="price">
                            Rp{{ number_format($product->product_price, 0, '', '.') }}
                        </span>
                        @else
                        <div class="product-price">
                            <span class="price">
                                Rp{{ number_format($product->product_discount, 0, '', '.') }}
                            </span>
                            <span class="price-before-discount">
                                Rp{{ number_format($product->product_price, 0, '', '.') }}
                            </span>
                        </div>
                        <!-- /.product-price -->
                        @endif

                    </div>
                    <!-- /.product-info -->

                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <div class="add-cart-button btn-group">
                                <button data-toggle="modal"  class="btn btn-primary icon" type="button" title="Keranjang" data-target="#product-modal" id="{{ $product->id }}" onclick="productView(this.id)">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                                <button class="btn btn-primary cart-btn" type="button">Keranjang</button>
                            </div>
                        </div>
                        <!-- /.action -->
                    </div>
                    <!-- /.cart -->
                </div>
            </div>
            @endforeach
        </div>
        <!-- /.sidebar-widget -->
    </div>
    <!-- ============================================== HOT DEALS: END ============================================== -->
