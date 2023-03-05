@extends('frontend.main-master')
@section('content')

    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="x-page inner-bottom-ms">
                <div class="row">
                    <div class="col-md-12 x-text text-center">
                        <h1>404</h1>
                        <p>Maaf, halaman yang anda minta tidak ditemukan. </p>
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i>kembali ke halaman utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
