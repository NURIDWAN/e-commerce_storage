@extends('frontend.main-master')
@section('content')

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ route('dashboard') }}">Profil</a></li>
                    <li class='active'>Detail Transaksi</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page" style="margin: 30px 0;">
                <div class="row">
                    <div class="col-md-7">
                        <h4>Rincian Produk</h4>
                        <hr>
                        @foreach ($orderItem as $item)
                            <div class="media product-cart">
                                <a href="" class="pull-left">
                                    <img src="{{ asset($item->product->product_thumbnail) }}" style=" width: 150px;"
                                        alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 style="font-size: 16px; font-weight: 500" class="media-heading">
                                        {{ $item->product->product_name }}
                                    </h4>
                                    <span style="float: right;">
                                        <a href="" data-toogle="modal" data-target="#product-modal"
                                            id="{{ $item->product_id }}" onclick="productView(this.id)"
                                            style="padding: 6px 40px;" class="btn btn-primary">Beli Lagi
                                        </a>
                                    </span>
                                    <p class=""> {{ $item->size }} - {{ $item->color }}</p>
                                    <p>{{ $item->product->product_code }}</p>
                                    <span style="float: right;">
                                        <a href="{{ url('product/details/'.$item->product_id."/".$item->product->product_slug)}}" style="padding: 6px 40px;">Beri Ulasan</a>
                                    </span>
                                    <p style="font-size: 14px">{{ $item->qty }}
                                        produk x Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        {{-- menampilka data pengiriman --}}
                        <h4 style="padding-top: 30px;">Info Pengiriman</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p>Nama</p>
                                <p>No Telepon</p>
                                <p>Email</p>
                                <p>Alamat</p>
                            </div>
                            <div class="col-md-8">
                                <p style="margin-bottom: 10px">
                                    <span style="margin-right: 10px">:</span>
                                    {{ $order->name }}
                                </p>
                                <p style="margin-bottom: 10px">
                                    <span style="margin-right: 10px">:</span>
                                    {{ $order->phone }}
                                </p>
                                <p style="margin-bottom: 10px">
                                    <span style="margin-right: 10px">:</span>
                                    {{ $order->email }}
                                </p>
                                <p style="margin-bottom: -20px">
                                    <span style="margin-right: 10px">:</span>
                                <div style="padding: 0 20px;">
                                    {{ $order->addres }} <br>
                                    {{ $order->district->name }}, {{ $order->city->name }}, <br>
                                    {{ $order->province->pname }}, {{ $order->poscode }}
                                </div>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($order->shipping_status == 'pending' || $order->shipping_status == 'Di Konfirmasi' || $order->shipping_status == 'Dikemas')
                                    @php
                                        //ambil data order berdasarkan id dengan kolom cencel_order bernilai null
                                        $order_cancel = App\Models\Order::where('id', $order->id)->where('cancel_order', '=', null)->first();
                                        //ambil data order berdasarkan id dengan kolom cencel_order benilai 1
                                        $cancel = App\Models\Order::where('id', $order->id)->where('cancel_order', '=', 1)->first();
                                    @endphp

                                    {{-- jika ada data order dengan kondisi  yang sesuai dengan variabel $order_cancel  --}}
                                    @if ($order_cancel)
                                        {{-- jika kolom cancel_order bernilai null --}}
                                        <h4 style="padding-top: 30px">Pembatalan Pesanan</h4>
                                        <hr>

                                        <form action="{{ route('cancel.order', $order->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="label" class="form-label">Alasan Pembatalan Pesanan</label>
                                                <textarea class="form-control" name="cancel_reason" id="label" rows="05" cols="30">Tulis Alasan</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger">Kirim</button>
                                        </form>
                                        {{-- jika ada data order dengan kondisi  yang sesuai dengan variabel $cancel --}}
                                    @elseif ($cancel)
                                        {{-- jika kolom cancel_order bernilai 1 --}}
                                        {{-- tampilkan ini --}}
                                        <br>
                                        <span class="badge badge-pill badge-warning"
                                            style="background-color: red; padding: 10px;">
                                            Anda telah mengirim permintaan pembatalan untuk produk ini
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @if ($order->shipping_status == 'selesai')
                                    @php
                                        //ambil data order berdasarkan id dengan kolom cencel_order bernilai null
                                        $order_cancel = App\Models\Order::where('id', $order->id)->where('cancel_order', '=', null)->first();
                                        //ambil data order berdasarkan id dengan kolom cencel_order benilai 1
                                        $cancel = App\Models\Order::where('id', $order->id)->where('cancel_order', '=', 1)->first();
                                    @endphp

                                    {{-- jika ada data order dengan kondisi  yang sesuai dengan variabel $order_cancel  --}}
                                    @if ($order_cancel)
                                        {{-- jika kolom cancel_order bernilai null --}}
                                        <h4 style="padding-top: 30px">Pembatalan Pesanan</h4>
                                        <hr>

                                        <form action="{{ route('return.order', $order->id) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="label" class="form-label">Alasan Pengembalian Pesanan</label>
                                                <textarea class="form-control" name="return_reason" id="label" rows="05" cols="30">Tulis Alasan</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger">Kirim</button>
                                        </form>
                                        {{-- jika ada data order dengan kondisi  yang sesuai dengan variabel $cancel --}}
                                    @elseif ($cancel)
                                        {{-- jika kolom cancel_order bernilai 1 --}}
                                        {{-- tampilkan ini --}}
                                        <br>
                                        <span class="badge badge-pill badge-warning"
                                            style="background-color: red; padding: 10px;">
                                            Anda telah mengirim permintaan pembatalan untuk produk ini
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <h4>Rincian Pembayaran</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p style="margin-bottom: 20px;">Status Pesanan</p>
                                <p>Invoice</p>
                                <p>Tanggal Pembelian</p>
                                <p>Metode Pembayaran</p>
                            </div>
                            <div class="col-md-8">
                                <p style="margin-bottom: 10px">
                                    @if ($order->shipping_status == 'pending')
                                        @if ($order->cancel_order == 2)
                                        <span class="badge badge-pill badge-warning"
                                        style="background: red; padding: 10px;">Batal
                                        </span>
                                        @else
                                        <span class="badge badge-pill badge-warning"
                                        style="background: #800080; padding: 10px;">Ditunda
                                        </span>
                                        @endif
                                    @elseif($order->shipping_status == 'Di Konfirmasi')
                                        @if ($order->cancel_order == 2)
                                        <span class="badge badge-pill badge-warning"
                                        style="background: red; padding: 10px;">Batal
                                        </span>
                                        @else
                                        <span class="badge badge-pill badge-warning"
                                        style="background: #0000ff; padding: 10px;">Di Konfirmasi
                                        </span>
                                        @endif
                                    @elseif($order->shipping_status == 'Dikemas')
                                        @if ($order->cancel_order == 1)
                                        <span class="badge badge-pill badge-warning"
                                        style="background: red; padding: 10px;">Batal
                                        </span>
                                        @else
                                        <span class="badge badge-pill badge-warning"
                                        style="background: #ffa500; padding: 10px;">Dikemas
                                        </span>
                                        @endif
                                    @elseif($order->shipping_status == 'Dikirim')
                                        <span class="badge badge-pill badge-warning"
                                            style="background: #808000; padding: 10px;">Dikirim</span>
                                    @elseif($order->shipping_status == 'Dalam Perjalanan')
                                        <span class="badge badge-pill badge-warning"
                                            style="background: #0000ff; padding: 10px;">Dalam Perjalanan</span>
                                    @elseif($order->shipping_status == 'selesai')
                                        <span class="badge badge-pill badge-warning"
                                            style="background: #0000ff; padding: 10px;">Selesai</span>

                                        @if ($order->return_order == 1)
                                            <div class="mt-3">
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: red; padding: 10px;">Permintaan <br>
                                                    Pengembalian</span>
                                            </div>
                                        @endif

                                        @if ($order->cancel_order == 1)
                                            <div class="mt-3">
                                                <span class="badge badge-pill badge-warning"
                                                    style="background: red; padding: 10px;">Batal</span>
                                            </div>
                                        @endif
                                    @endif
                                </p>
                                <p style="margin-bottom: 10px;">
                                    @if ($order->status == 'delivered')
                                        <a href="{{ url('user/invoice-download/',$order->id) }}" target="_blank"
                                            class="text-success"><i class="fa fa-print"></i>
                                            {{ $order->invoice_number }}
                                        </a>
                                    @else
                                        <span><i class="fa fa-print"></i>{{ $order->invoice_number }}</span>
                                    @endif
                                </p>
                                <p style="margin-bottom: 10px;">
                                    <span style="margin-bottom: 10px;">{{ $order->order_date }}</span>
                                </p>
                                <p style="margin-bottom: 10px;">
                                    <span class="">{{ $order->payment_method }}</span>
                                </p>
                                <p style="margin: 15px 0;">
                                    <span class="">
                                        <strong style="font-size: 16px;">Total Belanja</strong>
                                    </span>
                                    <span class="">
                                        <strong style="font-size: 16px;">
                                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                                        </strong>
                                    </span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
