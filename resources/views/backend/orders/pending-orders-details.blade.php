@extends('backend.admin-master')
@section('content')

<div class="container-fulll">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Details</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href=""><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail Transaksi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="box box-box-slided-up">
                    <div class="box-header with-border">
                        <h4 clas="box-title">Data Pembayaran </strong></h4>
                        <ul class="box-controls pull-right">
                            <li><a href="" class="box-btn-slide rotate-180"></a></li>
                            <li><a href="" class="box-btn-fullscreen"></a></li>
                        </ul>
                    </div>
                    <div class="box-body" style="display: block;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Nama</td>
                                    <td width="2%">:</td>
                                    <td>{{ $order->user->name }} | {{ $order->user->email }}</td>
                                </tr>
                                <tr>
                                    <td>No. HP</td>
                                    <td>:</td>
                                    <td>{{ $order->user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pesanan</td>
                                    <td>:</td>
                                    <td>{{ $order->order_date }}</td>
                                </tr>
                                <tr>
                                    <td>ID Pesanan <span class="text-info ml-1">Invoice</span></td>
                                    <td>:</td>
                                    <td>
                                        {{ $order->id }} / {{ $order->user_id }} / {{ $order->order_number }}
                                        <a href="{{ url('user/invoice-p/' .$order->id) }}" target="_blank" class="text-info">
                                            <i class="fa fa-print ml-1"></i>{{ $order->invoice_number }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $order->payment_method }}</td>
                                </tr>
                                <tr>
                                    <td>TRX ID</td>
                                    <td>:</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Total Harga</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($order->amount, 0, ',', '') }}</td>
                                </tr>
                                <tr>
                                    <td>Total Belanja</td>
                                    <td>:</td>
                                    <td>Rp {{ number_format($order->amount, 2, ',', '') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="box box-box-slided-up">
                    <div class="box-header with-border">
                        <h4 clas="box-title">Data Pengiriman </strong></h4>
                        <ul class="box-controls pull-right">
                            <li><a href="" class="box-btn-slide rotate-180"></a></li>
                            <li><a href="" class="box-btn-fullscreen"></a></li>
                        </ul>
                    </div>

                    <div class="box-body" style="display: block;">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Nama Penerima</td>
                                    <td width="2%">:</td>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <td>No Telepon Penerima</td>
                                    <td width="2%">:</td>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Pengiriman</td>
                                    <td width="2%">:</td>
                                    <td>{{ $order->addres }},{{ $order->district->name }}, <br>
                                        {{ $order->city->city_name }}, {{ $order->province->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pesanan</td>
                                    <td width="2%">:</td>
                                    <td>
                                        <span class="badge badge-pill badge-warning" style="background: #418DB9;">
                                            {{ $order->shipping_status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    @if($order->payment_method == 'Bank Transfer Manual')
                                    <td>
                                        <p><strong>Bukti Pembayaran</strong></p>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <img src="{{ asset($order->bukti_pembayaran) }}" alt="bukti-pembayaran" class="w-100 mt-n1">
                                    </td>
                                    @else
                                    @endif
                                </tr>
                                @if ($order->shipping_status == 'selesai')
                                    <tr>
                                        <td>Status Pengiriman</td>
                                        <td></td>
                                        <td>
                                            <p>Pesanan Tiba di Tujuan dan <br> Diterima oleh <strong class="text-info">{{ $order->name}}</strong> </p>
                                        </td>
                                    </tr>
                                    @php
                                        $adminData = DB::table('admins')->first()

                                    @endphp
                                    <tr>
                                        <td colspan="3">
                                            <em>Pembayaran diverifikasi oleh <strong class="text-info">{{$adminData->nama}}</strong>
                                            <br>
                                            <span class="text-info">{{ $order->updated_at}} WIB</span></em>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        @if($order->shipping_status == 'pending')
                                        <a href="{{ route('pending.confirm', $order->id) }}"
                                            class="btn btn-block btn-success" id="confirm">Konfirmasi Pesanan</a>
                                        @elseif($order->shipping_status == 'Di Konfirmasi')
                                        <a href="{{ route('confirm.picked', $order->id) }}"
                                            class="btn btn-block btn-success" id="picked">Kemas Pesanan</a>
                                        @elseif($order->shipping_status == 'Dikemas')
                                        <a href="{{ route('picked.shipped', $order->id) }}"
                                            class="btn btn-block btn-success" id="shipped">Kirim Pesanan</a>
                                        @elseif($order->shipping_status == 'Dikirim')
                                        <a href="{{ route('shipped.otw', $order->id) }}"
                                            class="btn btn-block btn-success" id="otw">Pesanan Di Perjalanan</a>
                                        @elseif($order->shipping_status == 'Dalam Perjalanan')
                                        <a href="{{ route('otw.delivered', $order->id) }}"
                                            class="btn btn-block btn-success" id="delivered">Pesanan Diterima</a>
                                        @endif

                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-12">
                <div class="box box-box-slided-up">
                    <div class="box-header with-border">
                        <h4 clas="box-title">Detail Produk </strong></h4>
                        <ul class="box-controls pull-right">
                            <li><a href="" class="box-btn-slide rotate-180"></a></li>
                            <li><a href="" class="box-btn-fullscreen"></a></li>
                        </ul>
                    </div>
                    <div class="box-body" style="display: block;">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="12%"></th>
                                        <th>Nama Produk</th>
                                        <th>Barcode</th>
                                        <th>Ukuran</th>
                                        <th>Warna</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItem as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1  }}</td>
                                        <td>
                                            <img src="{{ asset($item->product->product_thumbnail) }}" alt="" width="100px;">
                                        </td>
                                        <td>{{ $item->product->product_name }}</td>
                                        <td>{{ $item->product->product_code }}</td>
                                        <td>{{ $item->size }}</td>
                                        <td>{{ $item->color }}</td>
                                        <td>{{ $item->qty }} pcs</td>
                                        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                        @php
                                        $total = $item->qty * $item->price;
                                        @endphp
                                        <td>Rp{{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
