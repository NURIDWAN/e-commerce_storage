@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubah Data Coupon
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('coupon.update', $coupons->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Kupon <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="coupon_name" class="form-control" value="{{ $coupons->coupon_name }}">
                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Diskon Kupon(%)<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="coupon_discount" class="form-control" value="{{ $coupons->coupon_discount }}">
                                        @error('coupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Validasi Tanggal <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" id="" name="coupon_validity" class="form-control" placeholder="" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $coupons->coupon_validity }}">
                                        @error('coupon_validity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-5 pt-5">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Ubah">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
