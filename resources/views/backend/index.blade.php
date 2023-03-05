@extends('backend.admin-master')

@section('content')

@php
    $month_at = date('F');
    $month = App\Models\Order::where('order_month', $month_at)->sum('amount');

    $year_at = date('Y');
    $year = App\Models\Order::where('order_year', $year_at)->sum('amount');

    $pending = App\Models\Order::where('shipping_status', 'pending')->get();
@endphp
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
                <div class="col-xl-4 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-warning-light rounded w-60 h-60">
                                <i class="text-warning mr-0 font-size-24 fa fa-calendar-check-o"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Penjualan Bulan ini</p>
                                <h3 class="text-white mb-0 font-weight-500">Rp {{ number_format($month,0,'','.')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-info-light rounded w-60 h-60">
                                <i class="text-info mr-0 font-size-24 fa fa-calendar-check-o"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Penjualan tahun ini</p>
                                <h3 class="text-white mb-0 font-weight-500">Rp {{ number_format($year,0,'','.')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-6">
                    <div class="box overflow-hidden pull-up">
                        <div class="box-body">
                            <div class="icon bg-danger-light rounded w-60 h-60">
                                <i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
                            </div>
                            <div>
                                <p class="text-mute mt-20 mb-0 font-size-16">Pesanan Masuk</p>
                                <h3 class="text-white mb-0 font-weight-500">{{ count($pending)}}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title align-items-start flex-column">
                                Semua Pesanan Baru
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <thead>
                                        <tr class="text-uppercase bg-lightest">
                                            <th style="min-width: 250px"><span class="text-white">Tanggal</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Invoice</span></th>
                                            <th style="min-width: 100px"><span class="text-fade">Total bayar</span></th>
                                            <th style="min-width: 150px"><span class="text-fade">Metode Pembayaran</span></th>
                                            <th style="min-width: 130px"><span class="text-fade">Status</span></th>
                                            <th style="min-width: 120px"><span class="text-fade">Opsi</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $orders = App\Models\Order::where('shipping_status', 'pending')->orderBy('id', 'DESC')->get();
                                        @endphp

                                        @foreach ($orders as $item)
                                        <tr>
                                            <td class="pl-0 py-8">
                                                <span class="text-white font-weight-600 d-block font-size-16">
                                                    {{$item->order_date}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-white font-weight-600 d-block font-size-16">
                                                    {{$item->invoice_number}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-fade font-weight-600 d-block font-size-16">
                                                    Rp {{ number_format($year,0,'','.')}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-white font-weight-600 d-block font-size-16">
                                                    {{$item->payment_method}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary-light badge-lg">
                                                    {{$item->shipping_status}}
                                                </span>
                                            </td>
                                            <td class="text-left">
                                                <a href="{{ route('pending.orders')}}" class="waves-effect waves-light btn btn-info btn-circle">
                                                    <span class="mdi mdi-bookmark-plus"></span>
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
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
