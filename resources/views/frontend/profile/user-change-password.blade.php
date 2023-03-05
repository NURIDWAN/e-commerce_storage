@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li><a href="{{ route('user.profile') }}">Profile</a></li>
				<li class='active'>Ubah Kata Sandi </li>
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
                            Ubah Kata Sandi
                        </h3>
                        <hr>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.password.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">
                                                    Kata Sandi Saat Ini<span class="text-danger">*</span></label>
                                                <input type="password" id="current_password" name="oldpassword" class="form-control"
                                                value="" placeholder="Kata Sandi Saat Ini">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">
                                                    Kata Sandi Baru<span class="text-danger">*</span></label>
                                                <input type="password" id="password" name="password" class="form-control"
                                                value="" placeholder="Kata Sandi Baru">
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmail1">
                                                    Konfirmasi Kata Sandi<span class="text-danger">*</span></label>
                                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                                class="form-control"
                                                value="" placeholder="Konfirmasi Kata Sandi">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger">Ubah Kata Sandi</button>
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