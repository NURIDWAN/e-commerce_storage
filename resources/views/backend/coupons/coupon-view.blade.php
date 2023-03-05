@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Data Coupon
                            <span class="badge badge-pill badge-primary">{{ count($coupons) }}</span></h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th>Kupon</th>
                                        <th>Diskon Kupon</th>
                                        <th>Validasi</th>
                                        <th width="25%">Status</th>
                                        <th width="20%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupons as $key => $item )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->coupon_name }}</td>
                                        <td>{{ $item->coupon_discount }}%</td>
                                        <td width="25%">
                                            {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}</td>
                                        <td>
                                            @if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge-pill badge-success">Valid</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Invalid</span>
                                            @endif
                                        </td>
                                        <td width="25%">
                                            <a href="{{ route('coupon.edit', $item->id) }}" class="btn btn-sm btn-info" title="edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('coupon.delete', $item->id) }}" class="btn btn-sm btn-danger" title="hapus" id="delete"><i class="fa fa-trash"></i></a>
                                            {{-- @if($item->status == 1) --}}
                                            {{-- <a href="{{ route('slider.nonaktif', $item->id) }}" class="btn btn-danger btn-sm mt-1" tittle="Non Aktifkan"><i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('slider.aktif', $item->id) }}" class="btn btn-success btn-sm mt-1" tittle="Aktifkan"><i class="fa fa-arrow-up"></i></a>
                                            @endif --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Kupon</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Kupon <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="coupon_name" class="form-control" placeholder="Nama Kupon">
                                        @error('coupon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Diskon Kupon(%)<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="coupon_discount" class="form-control" placeholder="Diskon Kupon">
                                        @error('coupon_discount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Validasi Tanggal <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" id="" name="coupon_validity" class="form-control" placeholder="" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        @error('coupon_validity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-5 pt-5">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Tambah">
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
