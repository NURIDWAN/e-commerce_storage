<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">

                        <li>
                            <a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>Wishlist</a>
                        </li>
                        <li>
                            <a type="button"  data-toggle="modal" data-target="#ordertraking">
                            <i class="icon fa fa-check"></i>Order Traking
                            </a>
                        </li>



                        @auth
                        {{-- jika login berhasil tampilkan ini di header --}}
                        <li><a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>Akun Saya</a></li>
                        @else
                        {{-- jika belom tampilkan ini --}}
                        <li><a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>Masuk / Daftar</a>
                            @endauth
                        </li>
                    </ul>
                </div>
                <!-- /.cnt-account -->
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!--  TOP MENU : END  -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ==================== LOGO ========================================== -->
                    @php
                    $setting = App\Models\SiteSetting::find(1);
                    @endphp

                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset($setting->logo) }}" alt="logo">
                        </a>
                    </div>
                    <!-- /.logo -->
                    <!-- =============== LOGO : END =========================== -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ================= SEARCH AREA ====================================== -->
                    <div class="search-area">
                        <form method="post" action="{{ route('search.view') }}">
                            @csrf
                            <div class="control-group">
                                <input class="search-field" name="search" placeholder="Cari Disini..." />
                                <button class="search-button" type="submit"></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ================ SEARCH AREA : END ================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ========================== SHOPPING CART DROPDOWN ============================== -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
                                <div class="total-price-basket">
                                    <span class="total-price">
                                        <span class="sign">Rp</span>
                                        <span class="value" id="cartSubtotal"></span>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                {{-- mini cart --}}
                                <div id="miniCart">

                                </div>
                                <div class="clearfix cart-total">
                                    <div class="pull-right">
                                        <span class="text">Sub Total :</span>
                                        <span class='price' id="cartSubtotal"></span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('mycart') }}" class="btn btn-upper btn-primary btn-block m-t-20">Keranjang</a>
                                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Pembayaran</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ====== SHOPPING CART DROPDOWN : END====================== -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!--  NAVBAR  -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw">
                                    <a href="{{ url('/') }}">Beranda
                                    </a>
                                </li>

                                @php
                                $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
                                @endphp

                                @foreach ($categories as $category )
                                <li class="dropdown yamm mega-menu">
                                    <a data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name }}
                                    </a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                    {{-- mengambil data sub category --}}
                                                    @php
                                                    $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();
                                                    @endphp

                                                    @foreach ($subcategories as $subcat)
                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <a href="{{ url('subcategory/product/'.$subcat->id.'/'.$subcat->subcategory_slug) }}">
                                                            <h2 class="title">{{ $subcat->subcategory_name }}</h2>
                                                        </a>
                                                        {{-- mengambil data subsubcategory --}}
                                                        @php
                                                        $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcat->id)->orderBy('subsubcategory_name', 'ASC')->get();
                                                        @endphp

                                                        @foreach ($subsubcategories as $subsubcat )
                                                        <ul class="links">
                                                            <li>
                                                                <a href="{{ url('subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug) }}">
                                                                    {{ $subsubcat->subsubcategory_name }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        @endforeach
                                                    </div>
                                                    <!-- /.col -->
                                                    @endforeach

                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                        <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt="">
                                                    </div>
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach


                                <li class="dropdown  navbar-right special-menu"> <a href="#">Promo</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

    <div class="modal fade" id="ordertraking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lacak Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('order.tracking') }}">
                        @csrf
                        <div class="modal-body">
                            <label for="">Kode Invoice</label>
                            <input type="text" name="invoice_number" class="form-control" placeholder="Masukan Kode Invoce">
                        </div>
                        <button class="btn btn-danger" type="submit" style="margin-left: 17px;">cari</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</header>
