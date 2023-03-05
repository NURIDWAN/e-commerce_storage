<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="index.html">
                    <!-- logo for regular state and mobile devices -->
                    @php
                        $setting = App\Models\SiteSetting::find(1);
                    @endphp
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3>{{ $setting->company_name}}</h3>
                    </div>
                </a>
            </div>
        </div>


        @php
        $prefix = Request::route()->getPrefix();
        $route = Route::current()->getName()
        @endphp

        @php
            $brand = (auth()->guard('admin')->user()->brand == 1);
            $category = (auth()->guard('admin')->user()->category == 1);
            $product = (auth()->guard('admin')->user()->product == 1);
            $slider = (auth()->guard('admin')->user()->slider == 1);
            $coupon = (auth()->guard('admin')->user()->coupon == 1);
            $shipping = (auth()->guard('admin')->user()->shipping == 1);
            $orders = (auth()->guard('admin')->user()->orders == 1);
            $cancel = (auth()->guard('admin')->user()->cancel == 1);
            $return = (auth()->guard('admin')->user()->return == 1);
            $review = (auth()->guard('admin')->user()->review == 1);
            $stock = (auth()->guard('admin')->user()->stock == 1);
            $reports = (auth()->guard('admin')->user()->reports == 1);
            $alluser = (auth()->guard('admin')->user()->alluser == 1);
            $adminrole = (auth()->guard('admin')->user()->adminrole == 1);
            $setting = (auth()->guard('admin')->user()->setting == 1);

        @endphp

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ ($route == 'dashboard') ? 'active': '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="header nav-small-cap">Data Master</li>

            @if ($brand == true)
            <li class="treeview  {{ ($prefix == '/brand')?'active':'' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Merek</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'brand.view')? 'active': '' }}">
                        <a href="{{ route('brand.view') }}"><i class="ti-more"></i>Kelola Merek</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($category == true)
            <li class="treeview">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Kategori</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'category.view')? 'active': '' }}">
                        <a href="{{ route('category.view') }}"><i class="ti-more"></i>Kategori</a>
                    </li>
                    <li class="{{ ($route == 'category.view')? 'active':'' }}">
                        <a href="{{ route('subcategory.view') }}"><i class="ti-more"></i>Sub Kategori</a>
                    </li>
                    <li class="{{ ($route == 'category.view')? 'active' : '' }}">
                        <a href="{{ route('subsubcategory.view') }}"><i class="ti-more"></i>Sub->SubKategori</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($product == true)
            <li class="treeview {{ ($prefix == '/product')? 'active': '' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Produk</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'add.product')? 'active': '' }}">
                        <a href="{{ route('add.product') }}"><i class="ti-more"></i>Tambah Produk</a>
                    </li>
                    <li class="{{ ($route == 'manage.product')? 'active': '' }}">
                        <a href="{{ route('manage.product') }}"><i class="ti-more"></i>Kelola Produk</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($slider == true)
            <li class="treeview {{ ($prefix == '/slider')? 'active':'' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.slider')?'active':'' }}">
                        <a href="{{ route('manage.slider') }}"><i class="ti-more"></i>Kelola Slider</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($coupon == true)
            <li class="treeview {{ ($prefix == '/coupon')?'active':'' }}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Kupon</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.coupon')?'active':'' }}">
                        <a href="{{ route('manage.coupon') }}"><i class="ti-more"></i>Kelola Kupon</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($shipping == true)
            <li class="treeview">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Data Wilayah</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'manage.province')? 'active': '' }}">
                        <a href="{{ route('manage.province') }}"><i class="ti-more"></i>Provinsi</a>
                    </li>
                    <li class="{{ ($route == 'manage.city')? 'active': '' }}">
                        <a href="{{ route('manage.city') }}"><i class="ti-more"></i>Kota / Kabupaten</a>
                    </li>
                    <li class="{{ ($route == 'manage.district')? 'active': '' }}">
                        <a href="{{ route('manage.district') }}"><i class="ti-more"></i>Kecamatan</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($orders == true)
            <li class="header nav-small-cap">Kelola Pesanan</li>
            <li class="treeview">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Pesanan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'pending.orders')? 'active':'' }}">
                        <a href="{{ route('pending.orders') }}"><i class="ti-more"></i>Pesanan masuk</a>
                    </li>
                    <li class="{{ ($route == 'confirmed.orders')? 'active':'' }}">
                        <a href="{{ route('confirmed.orders') }}"><i class="ti-more"></i>Pesanan Di Konfirmasi</a>
                    </li>
                    <li class="{{ ($route == 'picked.orders')? 'active':'' }}">
                        <a href="{{ route('picked.orders') }}"><i class="ti-more"></i>Pesanan DiKemas</a>
                    </li>
                    <li class="{{ ($route == 'shipped.orders')? 'active':'' }}">
                        <a href="{{ route('shipped.orders') }}"><i class="ti-more"></i>Pesanan Dikirim</a>
                    </li>
                    <li class="{{ ($route == 'otw.orders')? 'active':'' }}">
                        <a href="{{ route('otw.orders') }}"><i class="ti-more"></i>Pesanan Dalam Perjalanan</a>
                    </li>
                    <li class="{{ ($route == 'delivered.orders')? 'active':'' }}">
                        <a href="{{ route('delivered.orders') }}"><i class="ti-more"></i>Pesanan Selesai</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($cancel == true)
            <li class="treeview {{ ($prefix == '/cancel') ? 'active' : ''}}" >
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Pembatalan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'cancel.request')? 'active' : ''}}">
                        <a href="{{ route('cancel.request')}}"><i class="ti-more"></i>Permintaan Pembatalan</a>
                    </li>
                    <li class="{{ ($route == 'cancel.all.request')? 'active' : ''}}">
                        <a href="{{ route('cancel.all.request')}}"><i class="ti-more"></i>Data Pembatalan</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($return == true)
            <li class="treeview {{ ($prefix == '/return') ? 'active' : ''}}" >
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Pengembalian</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'return.request')? 'active' : ''}}">
                        <a href="{{ route('return.request')}}"><i class="ti-more"></i>Permintaan Pengembalian</a>
                    </li>
                    <li class="{{ ($route == 'return.all.request')? 'active' : ''}}">
                        <a href="{{ route('return.all.request')}}"><i class="ti-more"></i>Data Pengembalian</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($review == true)
            <li class="treeview {{ ($prefix == '/review') ? 'active' : ''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Ulasan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'review.request')? 'active' : ''}}">
                        <a href="{{ route('review.request')}}"><i class="ti-more"></i>Ulasan Masuk</a>
                    </li>
                    <li class="{{ ($route == 'review.all.request')? 'active' : ''}}">
                        <a href="{{ route('review.all.request')}}"><i class="ti-more"></i>Data Ulasan</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($stock == true)
            <li class="treeview {{ ($prefix == '/stock') ? 'active' : ''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Stok Produk</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'product.stock')? 'active' : ''}}">
                        <a href="{{ route('product.stock')}}"><i class="ti-more"></i>Stok</a>
                    </li>
                </ul>
            </li>
            @endif

            <li class="header nav-small-cap">Pengaturan</li>
            @if ($reports == true)
            <li class="treeview {{ ($prefix == '/reports') ? 'active' : ''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Laporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'report.view')? 'active' : ''}}">
                        <a href="{{ route('report.view')}}"><i class="ti-more"></i>Laporan Transaksi</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($setting == true)
            <li class="treeview {{ ($prefix == '/setting') ? 'active' : ''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Pengaturan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'site.setting')? 'active' : ''}}">
                        <a href="{{ route('site.setting')}}"><i class="ti-more"></i>Website</a>
                    </li>
                    <li class="{{ ($route == 'seo.setting')? 'active' : ''}}">
                        <a href="{{ route('seo.setting')}}"><i class="ti-more"></i>Seo</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($alluser == true)
            <li class="treeview {{ ($prefix == '/all.users') ? 'active' : ''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Data User</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'all.users')? 'active' : ''}}">
                        <a href="{{ route('all.users')}}"><i class="ti-more"></i>User</a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($adminrole == true)
            <li class="treeview {{ ($prefix == '/adminrole') ? 'active' : ''}}">
                <a href="#">
                    <i data-feather="message-circle"></i>
                    <span>Data Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ ($route == 'admin.view')? 'active' : ''}}">
                        <a href="{{ route('admin.view')}}"><i class="ti-more"></i>Admin</a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
