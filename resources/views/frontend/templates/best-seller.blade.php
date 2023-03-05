<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Best Seller</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

            @foreach ($best_seller as $product)
            <div class="item">
                <div class="products special-product">
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="">
                                                <img src="{{ asset($product->product_thumbnail) }}">
                                            </a>
                                        </div>
                                        <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name">
                                            <a href="{{ url('product/details'.$product->id.'/'.$product->product_slug) }}">
                                                {{ $product->product_name }}
                                            </a>
                                        </h3>
                                        <div class="row">
                                            <div class=" m-t-20 ms-10">
                                                <div class="row">
                                                    @php
                                                        $reviews = App\Models\Review::where('product_id', $product->id)
                                                        ->max('rating');
                                                    @endphp
                                                    <div class="col-sm-8" style="padding-left: 30px;">
                                                        @if ($reviews == 0)
                                                        <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>
                                                            <span class="fa fa-star"></span>

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
                                            </div>
                                        </div>

                                        @if($product->product_discount ==NULL)
                                        <div class="product-price">
                                            <span class="price">
                                                Rp{{ number_format($product->product_price, 0, '','.') }}
                                            </span>
                                        </div>
                                        @else

                                        <div class="product-price">
                                            <span class="price">
                                                Rp{{ number_format($product->product_discount, 0, '','.') }}
                                            </span>
                                            <span class="price-before-discount">
                                                Rp{{ number_format($product->product_price, 0, '','.') }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
