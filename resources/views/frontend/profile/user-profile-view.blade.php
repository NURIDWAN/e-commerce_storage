@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('dashboard') }}">Beranda</a></li>
				<li class='active'>Profil Saya</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
        <div class="row">
            {{-- memanggil user sidebar --}}
            @include('frontend.templates.user-sidebar')

            <div class="col-md-10">
                <div class="sign-in-page" style="margin-bottom: 30px; padding: 10px 30px">
                    <div class="card">
                        <h3 class="text-left">
                            Profile Saya
                        </h3>
                        <hr>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.profile.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row px-3 py-4">
                                        <div class="col-md-8">
                                            <div class="form-group pb-2">
                                                <label class="info-title" for="exampleInputEmail1">Nama<span>*</span></label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                value="{{ $user->name }}">
                                            </div>

                                            <div class="form-group pb-2">
                                                <label class="info-title" for="exampleInputEmail1">Email<span>*</span></label>
                                                <input type="email" id="email" name="email" class="form-control"
                                                value="{{ $user->email }}">
                                            </div>

                                            <div class="form-group pb-2">
                                                <label class="info-title" for="exampleInputEmail1">No Telepon<span>*</span></label>
                                                <input type="text" id="phone" name="phone" class="form-control"
                                                value="{{ $user->phone }}">
                                            </div>

                                            <div class="form-group pb-2">
                                                <label class="info-title" for="exampleInputEmail1">Alamat<span>*</span></label>
                                                <textarea name="address" id="alamat" class="form-control" 
                                                placeholder="Jl Babakantiga No.82 Ciwidey"
                                                cols="30" rows="10">{!! $user->address !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group pb-2">
                                                <img id="showImage" class="img-fluid my-3 mx-auto d-block"
                                                        src="{{ (!empty($user->profile_photo_path)) ? url('upload/user-images/'.
                                                        $user->profile_photo_path) : url('upload/no-image.jpg') }}" alt="" 
                                                        style="width: 270px">
                                                <input type="file" id="profileImage" name="profile_photo_path" 
                                                class="form-control" style="margin-top: 15px">
                                            </div>
                                            <div class="form-group" style="margin-top: 10px">
                                            <button type="submit" class="btn btn-danger">Edit Profile</button>
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
@endsection