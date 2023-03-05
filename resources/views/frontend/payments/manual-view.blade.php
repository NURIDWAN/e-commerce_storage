@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li class='active'>Transfer Bank Manual</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box">
            <div class="row">
                <div class="col-md-6">
                    <div class="checkout-progress-sidebar">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Total Pembayaran</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        <li>
                                            {{-- jika memasukan kupon di halaman chekcout --}}
                                            @if(Session::has('coupon'))
                                            {{-- tampilkan sintak berikut --}}
                                            <strong>SubTotal: </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                            <hr>

                                            <strong>Kupon: </strong>
                                            {{ session()->get('coupon')['coupon_name'] }}
                                            ({{ session()->get('coupon')['coupon_discount'] }} % )
                                            <hr>

                                            <strong>Diskon Kupon: </strong>
                                            Rp{{ number_format(session()->get('coupon')['discount_amount'], 0, '', '.') }}
                                            <hr>

                                            <strong>Total Bayar: </strong>
                                            Rp{{ number_format(session()->get('coupon')['total_amount'], 0, '', '.') }}
                                            <hr>

                                            @else
                                            {{-- jika tidak memasdukan diskon kupon maka --}}
                                            <strong>SubTotal: </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                            <hr>

                                            <strong>Total Bayar: </strong>Rp{{ number_format($cartTotal, 0, '', '.') }}
                                            <hr>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="checkout-progress-sidebar">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Metode Pembayaran</h4>
                                </div>
                                <form action="{{ route('pay.manual') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <label for="card-element">
                                            <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                                            <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                                            <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                                            <input type="hidden" name="poscode" value="{{ $data['post_code'] }}">
                                            <input type="hidden" name="province_id" value="{{ $data['province_id'] }}">
                                            <input type="hidden" name="city_id" value="{{ $data['city_id'] }}">
                                            <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">
                                            <input type="hidden" name="addres" value="{{ $data['addres'] }}">
                                        </label>
                                    </div>
                                    <p style="margin-bottom: 20px; font-size: 14px;">Silahkan lakukan pembayaran transfer pada bank rekening berikut</p>
                                    <img src="{{ asset('frontend/assets/images/payments/bri.png') }}" alt="bri" style="width: 125px;">
                                    <h3 style="float: right; margin-top: 0px;">029872653781 <br><span style="font-size: 14px; font-style: italic;">A.n. Gi Company Store</span></h3>

                                    <div class="form-group mt-50">
                                        <br>
                                        <label class="" for="foto">Unggah Bukti Pembayaran <span class="text-danger"></span>
                                        </label>
                                        <input type="file" id="foto" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                                    </div>

                                    <p style="font-size: 12px; margin: 20px 0 15px; color: #b1b1b1b1">Saya menyetujui syarat dan ketentuan yang berlaku</p>
                                    <button class="btn btn-primary">Buat Pesanan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
