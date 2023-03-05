@extends('backend.admin-master')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pengaturan Seo
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('update.seosetting')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        
                                        <input type="hidden" name="id" value="{{ $seo->id }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h5>Meta title<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="meta_title"
                                                                    class="form-control"
                                                                    value="{{ $seo->meta_title }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>Meta Author<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="meta_author"
                                                                    class="form-control"
                                                                    value="{{ $seo->meta_author }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>Meta Keyword<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="meta_keyword" class="form-control"
                                                                    value="{{ $seo->meta_keyword }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>Meta Description<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <textarea name="meta_description" class="form-control">{!! $seo->meta_description !!}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <h5>Google Analytics<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <textarea name="google_analytics" class="form-control">{!! $seo->google_analytics !!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-primary mb-5" value="ubah">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
