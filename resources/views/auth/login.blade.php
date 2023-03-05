@extends('frontend.main-master')
@section('content')
    <!--  HEADER : END  -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li class='active'>Masuk / Daftar</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="col-md-6">
                <div class="sign-in-page">
                    <div class="row">

                        <!-- Sign-in -->
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form method="post" action="{{ isset($guard) ? url($guard . '/login') : route('login') }}">
                            @csrf
                            <div class="col-md-12 col-sm-12 sign-in">
                                <h4 class="text-center">Login</h4>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Email<span>*</span></label>
                                    <input type="email" id="email" name="email"
                                        class="form-control unicase-form-control text-input">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                    <input type="password" id="password" name="password"
                                        class="form-control unicase-form-control text-input">
                                </div>
                                <div class="radio outer-xs">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Ingat
                                        Saya!
                                    </label>
                                    <a href="{{ route('password.request') }}" class="forgot-password pull-right">lupa Kata
                                        Sandi?</a>
                                </div>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Masuk</button>
                            </div>
                        </form>
                        <div class="social-login" style="margin-top: 20px; display: blok; ">
                            <a href='{{ route('google.login')}}' class="btn border-primary" style="margin-top: 20px; justify-content: center; display: flex; "><img width="20px"
                                style="margin-bottom:3px; margin-right:5px;" alt="Google sign-in"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                                Login dengan Google</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sign-in -->


            <div class="col-md-6" style="margin-bottom: 50px">
                <div class="sign-in-page">
                    <div class="row">

                        <!-- create a new account -->
                        <div class="col-md-12 col-sm-12 create-new-account">
                            <h4 class="checkout-subtitle text-center">Daftar</h4>
                            <form method="POST" action="{{ route('register') }}" class="register-form outer-top-xs"
                                role="form">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Nama <span>*</span></label>
                                    <input type="text" id="name" name="name"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Email <span>*</span></label>
                                    <input type="email" id="email" name="email"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail2">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">No Telepon <span>*</span></label>
                                    <input type="text" id="phone" name="phone"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Kata Sandi <span>*</span></label>
                                    <input type="password" id="password" name="password"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1">Konfirmasi Kata Sandi
                                        <span>*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                                </div>
                                <button type="submit"
                                    class="btn-upper btn btn-primary checkout-page-button">Daftar</button>
                            </form>

                        </div>
                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <!--  BRANDS CAROUSEL  -->

        </div><!-- /.logo-slider-inner -->

    </div><!-- /.logo-slider -->
    <!--  BRANDS CAROUSEL : END  -->
    </div><!-- /.body-content -->
@endsection
