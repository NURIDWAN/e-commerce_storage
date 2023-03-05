@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubah Kategori</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('category.update', $categories->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $categories->id }}">
                                <div class="form-group">
                                    <h5>Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="category_name" class="form-control" value="{{ $categories->category_name }}">
                                        @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group pt-5 mt-5">
                                    <h5>Ikon <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="category_icon" class="form-control" value="{{ $categories->category_icon }}">
                                        @error('category_icon')
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
