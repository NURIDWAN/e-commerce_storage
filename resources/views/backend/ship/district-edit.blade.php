@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubah Kecamatan
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('district.update', $district->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Provinsi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="province_id" id="" class="form-control">
                                            <option value="" selected="" disabled="">Pilih Provinsi</option>
                                            @foreach ($province as $prov )
                                            <option value="{{ $prov->id }}" {{ $prov->id == $district->province_id ? 'selected' :'' }}>
                                                {{ $prov->province_name }}</option>
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
                                            <option value="{{ $kab->id }}" {{ $kab->id == $district->city_id ? 'selected' :'' }}>
                                                {{ $kab->city_name }}</option>
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
                                        <input type="text" name="district_name" class="form-control" value="{{ $district->district_name }}">
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

@endsection
