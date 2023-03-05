@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Beranda</a></li>
				<li class='active'>Lupa Kata Sandi</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page" style="margin-bottom: 30px">
			<div class="row">

				<!-- Sign-in -->

				@if(session('status'))
				<div class="mb-4 font-medium text-sm text-green-600">
					{{ session('status') }}
				</div>
				@endif

				<form method="post" action="{{ route('password.update') }}">
					@csrf
					<input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="col-md-6 col-sm-6 sign-in">	
                <h4 class="text-center">Lupa Kata Sandi</h4>        

		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email<span>*</span></label>
		    <input type="email" id="email" name="email" class="form-control unicase-form-control text-input"
			value="{{ $email ?? old('email') }}">
			<span class="text-danger">
				@error('email')
				{{ $message }}
				@enderror
			</span>
		</div>

		<div class="form-group">
		    <label class="info-title" for="password">Kata Sandi Baru<span>*</span></label>
		    <input type="password" id="password" name="password" class="form-control unicase-form-control text-input">
			<span class="text-danger">
				@error('password')
				{{ $message }}
				@enderror
			</span>
		</div>

		<div class="form-group">
		    <label class="info-title" for="password_confirmation">Konfirmasi Kata Sandi<span>*</span></label>
		    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input">
			<span class="text-danger">
				@error('password_confirmation')
				{{ $message }}
				@enderror
			</span>
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">
            Reset
        </button>
	</form>					
</div>
        </div>
    </div>
        </div>
    </div>
 @endsection