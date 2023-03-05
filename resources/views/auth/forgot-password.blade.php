@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ url('/') }}">Beranda</a></li>
				<li class='active'>Ganti Kata Sandi</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page" style="margin-bottom: 30px">
			<div class="row">

				<!-- Sign-in -->
                <div class="col-md-6 col-sm-6 sign-in">	
                <h4 class="text-center">Lupa Kata Sandi</h4>        
	<form method="post" action="{{ route('password.email') }}">
    @csrf
		<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email<span>*</span></label>
		    <input type="email" id="email" name="email" class="form-control unicase-form-control text-input">
		</div>
	  	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">
            Email Link Reset Password
        </button>
	</form>					
</div>
        </div>
    </div>
        </div>
    </div>
 @endsection