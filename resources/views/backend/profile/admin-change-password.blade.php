@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4>Ubah Kata Sandi</h4>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col">
                                <form method="POST" action="{{ route('update.change.password') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h5>Kata Sandi Saat Ini <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="password" id="current_password"
                                                                 name="oldpassword" class="form-control" required="" 
                                                                placeholder="Kata Sandi Saat Ini">
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h5>Kata Sandi Baru <span class="text-danger">*</span></h5>
                                                                <div class="controls">
                                                                    <input type="password" id="password"
                                                                     name="password" class="form-control" required="" 
                                                                    placeholder="Kata Sandi Baru">
                                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <h5>Konfirmasi Kata Sandi <span class="text-danger">*</span></h5>
                                                                    <div class="controls">
                                                                        <input type="password" id="password_confirmation"
                                                                         name="password_confirmation" class="form-control" required="" 
                                                                        placeholder="Konfirmasi Kata Sandi">
                                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Ubah">
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