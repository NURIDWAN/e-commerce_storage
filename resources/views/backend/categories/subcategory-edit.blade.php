@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubah Sub Kategori</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('subcategory.update', $subcategories->id) }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $subcategories->id }}">

                                <div class="form-group">
                                    <h5>Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select class="form-control" name="category_id" id="">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                 {{ $category->id == $subcategories->category_id ? 'selected' : '' }}>
                                                 {{ $category->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group pt-5 mt-5">
                                    <h5>Sub Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="subcategory_name" class="form-control" value="{{ $subcategories->subcategory_name }}">
                                        @error('subcategory_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-5 pt-5">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Ubah">
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
</section>
</div>


@endsection
