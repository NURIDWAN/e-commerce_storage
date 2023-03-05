@extends('frontend.main-master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li class='active'>Checkout</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="checkout-box">
                <div class="row">
                    <form action="{{ route('checkout.store') }}" method="post" class="register-form">
                        @csrf
                        @foreach ($carts as $item)
                            <input type="hidden" name="id_barang" value="{{ $item->id }}">
                            <input type="hidden" name="qty_barang" value="{{ $item->qty }}">
                        @endforeach
                        <div class="col-md-8">
                            <div class="panel-group checkout-steps" id="accordion">
                                <div class="panel panel-default checkout-step-01">
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row">
                                                <h4 class="checkout-subtitle" style="padding-right: 3px;"><b>Alamat Pengiriman</b></h4>
                                                <hr>
                                                <div class="col-md-6 col-sm-6 already-registered-login">

                                                    <div class="form-group">
                                                        <label for=""
                                                            class="info-title"><b>Nama</b><span>*</span></label>
                                                        <input type="text" name="shipping_name"
                                                            class="form-control unicase-form-control text-input"
                                                            placeholder="Nama" required=""
                                                            value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for=""
                                                            class="info-title"><b>Email</b><span>*</span></label>
                                                        <input type="email" name="shipping_email"
                                                            class="form-control unicase-form-control text-input"
                                                            placeholder="Email" required=""
                                                            value="{{ Auth::user()->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="info-title"><b>No
                                                                Telepon</b><span>*</span></label>
                                                        <input type="number" name="shipping_phone"
                                                            class="form-control unicase-form-control text-input"
                                                            placeholder="Nomor Telepon" required=""
                                                            value="{{ Auth::user()->phone }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="info-title"><b>Kode
                                                                Pos</b><span>*</span></label>
                                                        <input type="number" name="post_code"
                                                            class="form-control unicase-form-control text-input"
                                                            placeholder="Kode Pos" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 already-registered-login">
                                                    <div class="form-group">
                                                        <h5><b>Pilih Provinsi</b> <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select class="form-control" name="province_id" required=""
                                                                id="provinsi">
                                                                <option value="" selected="" disabled="">Pilih
                                                                    Provinsi</option>
                                                                @foreach ($provinces as $prov)
                                                                    <option value="{{ $prov->id }}">{{ $prov->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('province_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5><b>Pilih Kota / Kabupaten</b> <span class="text-danger">*</span>
                                                        </h5>
                                                        <div class="controls">
                                                            <select class="form-control" name="city_id" required=""
                                                                id="kabupaten">
                                                                <option value="" selected="" disabled="">Pilih
                                                                    Kota
                                                                    / Kabupaten</option>

                                                            </select>
                                                            @error('city_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5><b>Pilih Kecamatan</b> <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <select class="form-control" name="district_id" required=""
                                                                id="kecamatan">
                                                                <option value="" selected="" disabled="">Pilih
                                                                    Kecamatan</option>
                                                            </select>
                                                            @error('district_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="info-title">Alamat <span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="" cols="30" rows="5" name="addres" placeholder="Alamat"
                                                            required="">{!! Auth::user()->address !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="checkout-progress-sidebar">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">Ringkasan Pesanan</h4>
                                        </div>
                                        <div class="">
                                            <ul class="nav nav-checkout-progress list-unstyled">
                                                @foreach ($carts as $item)
                                                    <li>
                                                        <strong>Gambar: </strong>
                                                        <img src="{{ asset($item->options->image) }}" alt="produk"
                                                            style="height: 50px; width: 50px;">
                                                    </li>
                                                    <li>
                                                        <strong>Kuantitas: </strong>
                                                        ({{ $item->qty }})
                                                        <strong>Warna: </strong>
                                                        ( {{ $item->options->color }})

                                                        <strong>Size: </strong>
                                                        ( {{ $item->options->size }})
                                                    </li>
                                                @endforeach
                                                <hr>
                                                <li>
                                                    @if (Session::has('cupon'))
                                                        <strong>SubTotal:
                                                        </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                                        <hr>

                                                        <strong>Kupon: </strong>
                                                        {{ session()::get('cupon')['coupon_name'] }}
                                                        ( {{ session::get('coupon')['coupon_discount'] }} % )
                                                        <hr>

                                                        <strong>Total Pembayaran: </strong>
                                                        {{ session()::get('cupon')['discount_amount'] }}
                                                        <hr>
                                                    @else
                                                        <strong>SubTotal:
                                                        </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                                        <hr>
                                                        <strong>Total Pembayaran:
                                                        </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                                        <hr>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="checkout-progress-sidebar">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">Pilih Metode Pembayaran</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Stripe</label>
                                                <input type="radio" name="payment_method" value="stripe">
                                                <img src="{{ asset('frontend/assets/images/payments/4.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">COD</label>
                                                <input type="radio" name="payment_method" value="cash">
                                                <img src="{{ asset('frontend/assets/images/payments/cod.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="">Transfer</label>
                                                <input type="radio" name="payment_method" value="manual">
                                                <img src="{{ asset('frontend/assets/images/payments/bri.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button ">Lanjutkan Belanja</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <script type="text/javascript">
    $(document).ready(function() {
        $('select[name="province_id"]').on('change', function() {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: "{{ url('/user/city-get/ajax') }}/" + province_id
                    , type: 'GET'
                    , dataType: 'json'
                    , success: function(data) {
                        $.each(data, function(key, value) {
                            $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.city_name + '</option>');
                        });
                    }
                , });
            } else {
                alert('danger');
            }
        });

        $('select[name="city_id"]').on('change', function() {
            var city_id = $(this).val();
            if (city_id) {
                $.ajax({
                    url: "{{ url('/user/district-get/ajax') }}/" + city_id
                    , type: "GET"
                    , dataType: "json"
                    , success: function(data) {
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.district_name + '</option>');
                        });
                    }
                , });
            } else {
                alert('danger');
            }
        });
    });

</script> --}}

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function() {

                $('#provinsi').on('change', function() {
                    let id_provinsi = $('#provinsi').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getkabupaten') }}",
                        data: {
                            id_provinsi: id_provinsi
                        },
                        cache: false,
                        success: function($msg) {
                            $('#kabupaten').html($msg);

                        },
                        error: function(data) {
                            console.log('error:', data)
                        },
                    })
                })

                $('#kabupaten').on('change', function() {
                    let id_kabupaten = $('#kabupaten').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getkecamatan') }}",
                        data: {
                            id_kabupaten: id_kabupaten
                        },
                        cache: false,
                        success: function($msg) {
                            $('#kecamatan').html($msg);
                        },
                        error: function(data) {
                            console.log('error:', data)
                        },
                    })
                })
            })




        })
    </script>
@endsection
