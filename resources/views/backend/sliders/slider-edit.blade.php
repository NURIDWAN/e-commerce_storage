@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubah Slider</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $sliders->id }}">
                                <input type="hidden" name="old_image" value="{{ $sliders->slider_img }}">
                                <div class="form-group">
                                    <h5>Judul <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="title" class="form-control" value="{{ $sliders->title }}">
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Deskripsi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="description" class="form-control" value="{{ $sliders->description }}">
                                        @error('category_icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Gambar <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" id="" name="slider_img" class="form-control" value="{{ $sliders->slider_img }}">
                                        @error('slider_img')
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
