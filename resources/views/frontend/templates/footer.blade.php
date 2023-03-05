<!-- ============================= FOOTER =========================================== -->
@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">{{ $setting->company_name }}</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
                    <p style="color: #666;">
                        {!!$setting->description!!}
                    </p>
            </div>
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Link</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
              <ul class='list-unstyled'>
                <li class="first"><a href="#" title="Your Account">Tentang Kami</a></li>
                <li><a href="#" title="Information">Pelayanan Pelanggan</a></li>
                <li><a href="#" title="Information">Brand</a></li>
                <li><a href="#" title="Addres">Kontak</a></li>
              </ul>
            </div>
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Pelayanan Pelanggan</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
              <ul class='list-unstyled'>
                <li class="first"><a title="Contact Us" href="#">Akun Saya</a></li>
                <li><a title="faq" href="#">FAQ</a></li>
                <li><a title="Popular Searches" href="#">Promo</a></li>
                <li class="last"><a title="Where is my order?" href="#">Bantuan</a></li>
              </ul>
            </div>
            <!-- /.module-body -->
          </div>
          <!-- /.col -->

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="module-heading">
              <h4 class="module-title">Hubungi Kami</h4>
            </div>
            <!-- /.module-heading -->

            <div class="module-body">
              <ul class="toggle-footer" style="">
                <li class="media">
                <div class="pull-left">
                <span class="icon fa-stack fa-lg">
                 <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
                 </span>
                </div>
                <div class="media-body">
                <p>{{$setting->company_address}}</p>
                </div>
                </li>

                 <li class="media">
                <div class="pull-left">
                <span class="icon fa-stack fa-lg">
                 <i class="fa fa-whatsapp fa-stack-1x fa-inverse"></i>
                 </span>
                </div>
                <div class="media-body">
                <p> {{$setting->phone_one}} <br>
                    {{$setting->phone_two}}
                </p>
                </div>
                </li>

                 <li class="media">
                <div class="pull-left">
                <span class="icon fa-stack fa-lg">
                 <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                 </span>
                </div>
                <div class="media-body">
                <span><a href="#">{{$setting->email}}</a></span>
                </div>
                </li>

              </ul>
            </div>
            <!-- /.module-body -->
          </div>
        </div>
      </div>
    </div>

    <div class="copyright-bar">
      <div class="container">
        <div class="col-xs-12 col-sm-12 no-padding social">
          <p class="text-center">
            @php
            $year = Illuminate\Support\Carbon::now()->format('Y');
            @endphp
            <i class="fa fa-copyright" aria-hidden="true"></i>
            {{$year}} {{$setting->company_name}} All Rights Reserved
          </p>
        </div>
      </div>
    </div>

  </footer>
  <!-- ============================================================= FOOTER : END============================================================= -->
