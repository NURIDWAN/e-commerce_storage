@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Provinsi
                            <span class="badge badge-pill badge-primary">{{ count($province) }}</span>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Provinsi</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($province as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1  }}</td>
                                        <td>{{ $item }}</td>
                                        {{-- <td>
                                            <a href="{{ route('province.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('province.delete', $item->id) }}" class="btn btn-sm btn-danger" title="Hapus Data" id="">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td> --}}
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
                        <h3 class="box-title">Tambah Provinsi</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('province.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Provinsi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="province_name" class="form-control" placeholder="Nama Provinsi">
                                        @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-md btn-primary mb-5" value="Tambah">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

</div>


@endsection
