
@extends('frontend.main-master')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class='active'>Pengembalian Pesanan</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="row">

                @include('frontend.templates.user-sidebar')
                <div class="col-md-10">
                    <div class="sign-in-page">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Total Biaya</th>
                                        <th class="text-center">Metode Pembayaran</th>
                                        <th class="text-center">Invoice</th>
                                        <th class="text-center">Alasan Pengembalian</th>
                                        <th class="text-center">Status Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="col-md-1">
                                                <label for="">{{ $order->order_date}}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for="">Rp{{ number_format($order->amount, 2, ',', '.' )  }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for="">{{ $order->payment_method }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for="">{{ $order->invoice_number }}</label>
                                            </td>
                                            <td class="col-md-4">
                                                <label for="">{{ $order->return_reason }}</label>
                                            </td>
                                            <td class="col-md-2">
                                                <label for="">
                                                    @if ($order->return_order == 0)
                                                    <div class="mt-3">
                                                        <span class="badge badge-pill badge-warning" style="background: #418DB9; padding: 10px;">Tidak ada permintaan</span>
                                                    </div>
                                                    @elseif($order->return_order == 1)
                                                    <div class="mt-3">
                                                        <span class="badge badge-pill badge-warning" style="background: #800000; padding: 10px;">Di Tunda</span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <span class="badge badge-pill badge-warning" style="background: red; padding: 10px;">Permintaan Pengembalian</span>
                                                    </div>
                                                    @elseif ($order->return_order == 2)
                                                    <div class="mt-3">
                                                        <span class="badge badge-pill badge-warning" style="background: #008000; padding: 10px;">Pengembalian Berhasil</span>
                                                    </div>
                                                    @endif
                                                </label>
                                            </td>
                                        </tr>

                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
