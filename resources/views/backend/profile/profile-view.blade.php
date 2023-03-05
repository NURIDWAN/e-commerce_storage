@extends('backend.admin-master')
@section('content')

<div class="container-full">

    {{-- main content --}}
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-widget widget-user">
                    {{-- add the color --}}
                    <div class="widget-user-header bg-black"
                     style="background: url('../images/gallery/full/10.jpg') center center;">
                    <h3 class="widget-user-username">{{ $adminData->nama }}</h3>
                    <h6 class="widget-user-desc">{{ $adminData->email }}</h6>
                    </div>
                    <div class="widget-user-image">
                        <img class="rounded-circle"
                        src="{{ (!empty($adminData->profile_photo_path)) ? url('upload/admin-images/'.
                        $adminData->profile_photo_path) : url('upload/no-image.jpg') }}"
                        alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="description-block">
                              <h5 class="description-header">12K</h5>
                              <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 br-1 bl-1">
                            <div class="description-block">
                              <h5 class="description-header">550</h5>
                              <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4">
                            <div class="description-block">
                              <h5 class="description-header">158</h5>
                              <span class="description-text">TWEETS</span>
                            </div>
                            <!-- /.description-block -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <a href="#" class="btn btn-primary btn-block mt-4">
                            <b>Ikuti</b>
                        </a>
                      </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Edit Profile</h4>
                        </div>
                        {{-- box header --}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form method="post" action="{{ route('admin.profile.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Ussername <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="nama" class="form-control" required="" 
                                                                value="{{ $adminData->nama }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Email <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="email" class="form-control" required="" 
                                                                value="{{ $adminData->email }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5>Foto Profil <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="file" name="profile_photo_path" 
                                                                class="form-control" id="profileImage">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img id="showImage" 
                                                        src="{{ (!empty($adminData->profile_photo_path)) ? url('upload/admin-images/'.
                                                        $adminData->profile_photo_path) : url('upload/no-image.jpg') }}" alt="" 
                                                        style="width: 100px; height: 100px;">
                                                    </div>
                                                </div>
                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- ajak image profile --}}
<script>
    $(document).ready(function () {
        $('#profileImage').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection