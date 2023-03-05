@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Kota Kecamatan
                            <span class="badge badge-pill badge-primary">{{ count($district) }}</span>
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Provinsi</th>
                                        <th>Kota / Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($district as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1  }}</td>
                                        <td>{{ $item->province->province_name }}</td>
                                        <td>{{ $item->city->city_name }}</td>
                                        <td>{{ $item->district_name }}</td>
                                        <td width="40%">
                                            <a href="{{ route('district.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('district.delete', $item->id) }}" class="btn btn-sm btn-danger" title="Hapus Data" id="">
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

            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Kecamatan</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('district.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Provinsi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="province_id" id="" class="form-control">
                                            <option value="" selected="" disabled="">Pilih Provinsi</option>
                                            @foreach ($province as $prov )
                                            <option value="{{ $prov->id }}">{{ $prov->province_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Kota / Kabupaten <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="city_id" id="" class="form-control">
                                            <option value="" selected="" disabled="">Pilih Kota / Kabupaten</option>
                                            @foreach ($city as $kab )
                                            <option value="{{ $kab->id }}">{{ $kab->city_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Kecamatan <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="district_name" class="form-control" placeholder="Nama Kecamatan">
                                        @error('district_name')
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
