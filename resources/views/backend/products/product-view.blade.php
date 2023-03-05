@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Produk
                            <span class="badge badge-pill badge-primary">{{ count($products) }}</span></h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="25%">Foto</th>
                                        <th>Barcode</th>
                                        <th width="15%">Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $item )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height: 70px;" alt="">
                                        </td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>Rp {{ number_format($item->product_price,0,'','.') }}</td>
                                        <td>
                                            {{-- jika discount tidak ada maka --}}
                                            @if($item->product_discount == NULL)
                                            {{-- tampikan ini --}}
                                            <span class="badge badge-pill badge-danger">Tidak Ada Diskon</span>

                                            @else
                                            {{-- jika produk discount ada jalankan ini --}}
                                            @php
                                            $amount = $item->product_price - $item->product_discount;
                                            $discount = ($amount/$item->product_price) * 100;
                                            @endphp
                                            {{-- kemudian tampilkan ini --}}
                                            <span class="badge badge-pill badge-danger">{{ round($discount) }} %</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->product_qty }}</td>
                                        <td>
                                            {{-- jika produk status true 1--}}
                                            @if($item->product_status == 1)
                                            {{-- makatampilkan ini --}}
                                            <span class="badge badge-pill badge-success">Aktif</span>
                                            @else
                                            {{-- jika false maka tampilkan --}}
                                            <span class="badge badge-pill badge-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td width="20%">
                                            <a href="{{ route('product.edit', $item->id) }}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('product.delete', $item->id) }}" class="btn btn-sm btn-danger" title="hapus" id="delete"><i class="fa fa-trash"></i></a>

                                            @if($item->product_status == 1)
                                            <a href="{{ route('product.inactive', $item->id) }}" class="btn btn-sm btn-danger" title="non aktifkan"><i class="fa fa-arrow-down"></i>
                                            </a>
                                            @else
                                            <a href="{{ route('product.active', $item->id) }}" class="btn btn-sm btn-success" title="aktifkan"><i class="fa fa-arrow-up"></i>
                                            </a>
                                            @endif
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
