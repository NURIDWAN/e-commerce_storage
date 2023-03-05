@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Slider
                            <span class="badge badge-pill badge-primary">{{ count($sliders) }}</span></h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="15%">Gambar</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th width="20%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $key => $item )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($item->slider_img) }}" alt="" style="width: 70px; height: 40px;">
                                        </td>
                                        <td>
                                            @if($item->title == NULL)
                                            <span class="badge badge-pill badge-primary">Tidak Ada Judul </span>
                                            @else
                                            {{ $item->title }}
                                            @endif
                                        </td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge badge-pill badge-primary">Aktif</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Non Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('slider.delete', $item->id) }}" class="btn btn-sm btn-danger" title="hapus" id="delete"><i class="fa fa-trash"></i></a>
                                            @if($item->status == 1)
                                            <a href="{{ route('slider.nonaktif', $item->id) }}" class="btn btn-danger btn-sm mt-1" tittle="Non Aktifkan"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('slider.aktif', $item->id) }}" class="btn btn-success btn-sm mt-1" tittle="Aktifkan"><i class="fa fa-arrow-up"></i></a>
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

            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Slider</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Judul <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="title" class="form-control" placeholder="Judul">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Deskripsi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="description" class="form-control" placeholder="Deskripsi">
                                        @error('category_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Gambar <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" id="" name="slider_img" class="form-control" placeholder="Gambar">
                                        @error('slider_img')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-5 pt-5">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Tambah">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
