    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
        <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">

                {{-- mengambil data bramd --}}
                @php
                $brands = App\Models\Brand::latest()->get();
                @endphp

                @foreach ($brands as $brand)
                <div class="item m-t-15">
                    <a href="#" class="image">
                        <img style="width: 150px" data-echo="{{ asset($brand->brand_image) }}" src="{{ asset($brand->brand_image) }}" alt="">
                    </a>
                </div>
                <!--/.item-->
                @endforeach
            </div>
            <!-- /.owl-carousel #logo-slider -->
        </div>
        <!-- /.logo-slider-inner -->

    </div>
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
