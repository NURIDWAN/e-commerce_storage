@extends('frontend.main-master')
@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ url('/') }}">Beranda</a></li>
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
                <h4 class="text-center">
                    {{-- menampilkan nama yang login --}}
                    Selamat Datang <strong class="text-danger">{{ Auth::user()->name }}</strong> Di Toko Kami
                </h4>
            </div>
        </div>
    </div>
</div>

@endsection
