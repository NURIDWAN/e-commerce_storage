@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li class='active'>Keranjang</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart-table">
                    <div class="table-responsive">
                        <table class="table">   
                            <thead>
                                <tr>
                                    <th class="col-md-3">Produk</th>
                                    <th class="col-md-2"></th>
                                    <th class="col-md-3">Kuantitas</th>
                                    <th class="col-md-2">Sub Total</th>
                                    <th class="col-md-1">Opsi</th>
                                </tr>
                            </thead>
                            <tbody id="cartPage">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12"></div>
                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    @if (Session::has('coupon'))
                        @else
                        <table class="table" id="couponField">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Kupon Diskon</span>
                                        <p>masukan jika anda memiliki kode kupon</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="coupon_name" class="form-control unicase-form-control text-input" placeholder="Masukan Kupon Disini">
                                        </div>
                                        <div class="clearfix pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary" onclick="applyCoupon()">Gunakan
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <div class="col-md-4 col-sm-12 cart-shopping-total">
                        <table class="table">
                            <thead id="couponCalField">
                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a href="{{ route('checkout') }}" type="submit" class="btn btn-primary checkout-btn">LANJUTKAN BELANJA</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<br>
<br>

@endsection
