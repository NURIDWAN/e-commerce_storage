@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
          <div class="col-8">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Data Provinsi
                </h3>
              </div>
                <div class="box-body">
                    <div class="table-responsive">
                      <form method="post" action="{{ route('province.update', $provinces->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <h5>Provinsi <span class="text-danger">*</span></h5>
                          <div class="controls">
                            <input type="text" name="province_name"
                            class="form-control" value="{{ $provinces->province_name }}">
                            @error('province_name')
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
    
    </div>

@endsection