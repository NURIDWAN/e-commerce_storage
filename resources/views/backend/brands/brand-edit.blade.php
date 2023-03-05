@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Ubah Merek
                </h3>
              </div>
              <div class="box-body">
                <div class="box-body">
                    <div class="table-responsive">
                      <form method="post" action="{{ route('brand.update', $brands->id) }}" enctype="multipart/form-data">
                        @csrf

                        {{-- mengambil data berdasarkan id yg diambil --}}
                        <input type="hidden" name="id" id="" value="{{ $brands->id }}">
                        <input type="hidden" name="old_image" id="" value="{{ $brands->brand_image }}">

                        <div class="form-group">
                          <h5>Merek <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input type="text" name="brand_name" id=""
                            class="form-control" placeholder="Nama Merek"
                            value="{{ $brands->brand_name }}">
                            @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group">
                          <h5>Gambar <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input type="file" name="brand_image" id=""
                            class="form-control" placeholder="Gambar Merek"
                            value="">
                            @error('brand_image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="text-xs-right">
                          <input type="submit" class="btn btn-md btn-primary mb-5" value="Perbaharui">
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