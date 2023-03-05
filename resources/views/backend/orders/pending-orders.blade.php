@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Transaksi
                            <span class="badge badge-pill badge-primary">{{ count($orders) }}</span>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Tanggal Pesanan</th>
                                        <th>ID Pesanan</th>
                                        <th>Invoice</th>
                                        <th>Pembayaran</th>
                                        <th>Total Belanja</th>
                                        <th>Status</th>
                                        <th width="15%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1  }}</td>
                                        <td>{{ $item->order_date }}</td>
                                        <td>{{ $item->id }}/{{ $item->user_id }}/{{ $item->order_number }}</td>
                                        <td>{{ $item->invoice_number }}</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>Rp{{ number_format($item->amount, 2, ',', '.') }}</td>
                                        <td>
                                            <span class="badge badge-pill badge-primary">
                                                {{ $item->shipping_status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('pending.order.details', $item->id) }}" class="btn btn-info" title="detail transaksi"><i class="fas fa-pen-square mr-1"></i>Lihat
                                            </a>
                                        </td>
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
