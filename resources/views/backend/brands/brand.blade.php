@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
          <div class="col-8">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Data Merek
                  <span class="badge badge-pill badge-primary">{{ count($brands) }}</span>
                </h3>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>Merek</th>
                        <th>Slug</th>
                        <th width="25%">Gambar</th>
                        <th width="20%">Opsi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($brands as $key => $item)
                          <tr>
                            <td>{{ $key + 1  }}</td>
                            <td>{{ $item->brand_name }}</td>
                            <td>{{ $item->brand_slug }}</td>
                            <td>
                              <img src="{{ asset($item->brand_image) }}" alt="BRAND" class="w-50">
                            </td>
                            <td>
                              <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit Data">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="{{ route('brand.delete', $item->id) }}" class="btn btn-sm btn-danger" 
                                title="Hapus Data" id="delete">
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
                <h3 class="box-title">Tambah Merek</h3>
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <form method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <h5>Merek <span class="text-danger">*</span></h5>
                      <div class="controls">
                        <input type="text" name="brand_name" id=""
                        class="form-control" placeholder="Nama Merek">
                        @error('brand_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <h5>Gambar <span class="text-danger">*</span></h5>
                      <div class="controls">
                        <input type="file" name="brand_image" id=""
                        class="form-control" placeholder="Gambar Merek">
                        @error('brand_image')
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