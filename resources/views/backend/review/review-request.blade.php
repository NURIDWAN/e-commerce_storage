@extends('backend.admin-master')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Permintaan Pengembalian
                                {{-- <span class="badge badge-pill badge-primary">{{ count($orders) }}</span> --}}
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Ulasan</th>
                                            <th>Pelanggan</th>
                                            <th>Produk</th>
                                            <th>Status</th>
                                            <th width="15%">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($review as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->comment }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-pill badge-primary">
                                                            Ditunda
                                                        </span>
                                                    @elseif ($item->status == 2)
                                                    <span class="badge badge-pill badge-success">
                                                        Di Upload
                                                    </span>
                                                    @endif
                                                </td>
                                                <td width="25%">
                                                    <a href="{{ route('review.approve', $item->id)}}" class="btn btn-danger">Upload</a>
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
