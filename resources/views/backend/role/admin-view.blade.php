@extends('backend.admin-master')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Pembatalan
                                {{-- <span class="badge badge-pill badge-primary">{{ count($orders) }}</span> --}}
                            </h3>
                            <a href="{{ route('add.admin')}}" class="btn btn-primary" style="float: right;">Tambah Admin</a>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Hak Akses</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($adminuser as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img src="{{ (!empty($item->profile_photo_path))? url('upload/admin-images/'.$item->profile_photo_path):url('upload/no_image.jpg')}}" width="50px" height="50px" alt="">
                                                </td>
                                                <td>{{ $item->nama}}</td>
                                                <td>{{ $item->email}}</td>
                                                <td>
                                                    @if ($item->brand ==1)
                                                        <span class="badge btn-primary">Merek</span>
                                                    @else
                                                    @endif
                                                    @if ($item->category ==1)
                                                        <span class="badge btn-secondary">Kategory</span>
                                                    @else
                                                    @endif
                                                    @if ($item->product ==1)
                                                        <span class="badge btn-success">Produk</span>
                                                    @else
                                                    @endif
                                                    @if ($item->slider ==1)
                                                        <span class="badge btn-danger">Slider</span>
                                                    @else
                                                    @endif
                                                    @if ($item->coupon ==1)
                                                        <span class="badge btn-warning">Kupon</span>
                                                    @else
                                                    @endif
                                                    @if ($item->shipping ==1)
                                                        <span class="badge btn-info">Pengiriman</span>
                                                    @else
                                                    @endif
                                                    @if ($item->orders ==1)
                                                        <span class="badge btn-success">Pesanan</span>
                                                    @else
                                                    @endif
                                                    @if ($item->cancel ==1)
                                                        <span class="badge btn-light">Pembatalan</span>
                                                    @else
                                                    @endif
                                                    @if ($item->return ==1)
                                                        <span class="badge btn-primary">Pengembalian</span>
                                                    @else
                                                    @endif
                                                    @if ($item->review ==1)
                                                        <span class="badge btn-secondary">Ulasan</span>
                                                    @else
                                                    @endif
                                                    @if ($item->stock ==1)
                                                        <span class="badge btn-danger">Stok</span>
                                                    @else
                                                    @endif
                                                    @if ($item->setting ==1)
                                                        <span class="badge btn-dark">Pengaturan</span>
                                                    @else
                                                    @endif
                                                    @if ($item->alluser ==1)
                                                        <span class="badge btn-info">Data Pelanggan</span>
                                                    @else
                                                    @endif
                                                    @if ($item->adminrole ==1)
                                                        <span class="badge btn-dark">Data Admin</span>
                                                    @else
                                                    @endif
                                                    @if ($item->reports ==1)
                                                        <span class="badge btn-warning">Laporan</span>
                                                    @else
                                                    @endif

                                                </td>
                                                <td >
                                                    <a href="{{ route('edit.admin', $item->id)}}" class="btn btn-sm btn-info" title="Edit Data">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('delete.admin', $item->id)}}" class="btn btn-sm btn-danger" title="Delete" id="delete">
                                                        <i class="fa fa-trash"></i>
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
