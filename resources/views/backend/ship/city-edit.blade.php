@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Kota / Kabupaten
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('city.update', $cities->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="hidden" name="id" value="{{ $cities->id }}"> --}}
                                <div class="form-group">
                                    <h5>Provinsi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="province_id" id="" class="form-control">
                                            <option value="" selected="" disabled="">Pilih Provinsi</option>
                                            @foreach ($provinces as $item )
                                            <option value="{{ $item->id }}" {{ $item->id == $cities->province_id ? 'selected': '' }}>
                                                {{ $item->province_name }}</option>
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
                                        <input type="text" name="city_name" class="form-control" placeholder="Nama Kota / Kabupaten" value="{{ $cities->city_name }}">
                                        @error('city_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-md btn-primary mb-5" value="Ubah">
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
