@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub Kategori
                            <span class="badge badge-pill badge-primary">{{ count($subcategories) }}</span></h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Kategori</th>
                                        <th>Sub Kategori</th>
                                        <th>Slug</th>
                                        <th width="20%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($subcategories as $key => $item )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['category']['category_name'] }}</td>
                                        <td>{{ $item->subcategory_name }}</td>
                                        <td>{{ $item->subcategory_slug }}</td>
                                        <td>
                                            <a href="{{ route('subcategory.edit', $item->id) }}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('subcategory.delete', $item->id) }}" class="btn btn-sm btn-danger" title="hapus" id="delete"><i class="fa fa-trash"></i></a>
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
                        <h3 class="box-title">Tambah Sub Kategori</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select class="form-control" name="category_id" id="">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group pt-5 mt-5">
                                    <h5>Sub Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="subcategory_name" class="form-control" placeholder="Nama Sub Kategori">
                                        @error('subcategory_name')
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
