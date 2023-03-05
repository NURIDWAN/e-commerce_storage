@extends('backend.admin-master')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Permintaan Pembataln
                                {{-- <span class="badge badge-pill badge-primary">{{ count($orders) }}</span> --}}
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Total Bayar</th>
                                            <th>Metode Bayar</th>
                                            <th>Status</th>
                                            <th width="15%">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->order_date }}</td>
                                                <td>{{ $item->invoice_number }}</td>
                                                <td>Rp{{ number_format($item->amount, 2, ',', '.') }}</td>
                                                <td>{{ $item->payment_method }}</td>
                                                <td>
                                                    @if ($item->cancel_order == 1)
                                                        <span class="badge badge-pill badge-primary">
                                                            Ditunda
                                                        </span>
                                                    @elseif ($item->cancel_order == 2)
                                                    <span class="badge badge-pill badge-success">
                                                        Berhasil
                                                    </span>
                                                    @endif
                                                </td>
                                                <td width="25%">
                                                    <a href="{{ route('cancel.approve', $item->id)}}" class="btn btn-danger">Batalkan</a>
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
