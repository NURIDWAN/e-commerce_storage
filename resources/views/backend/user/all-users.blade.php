@extends('backend.admin-master')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Pembatalan
                                {{-- <span class="badge badge-pill badge-primary">{{ count($orders) }}</span> --}}
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Telepon</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <img src="{{ (!empty($user->profile_photo_path))? url('upload/user-images/'.$user->profile_photo_path):url('upload/no_image.jpg')}}" width="50px" height="50px" alt="">
                                                </td>
                                                <td>{{ $user->name}}</td>
                                                <td>{{ $user->email}}</td>
                                                <td>{{ $user->phone}}</td>
                                                <td>
                                                    @if ($user->UserOnline())
                                                    <span class="badge badge-pill badge-success">
                                                        Sedang Aktif
                                                    </span>
                                                    @else
                                                    <span class="badge badge-pill badge-danger">
                                                        {{ Illuminate\Support\Carbon::parse($user->last_seen)->diffForHumans() }}
                                                    </span>
                                                    @endif
                                                </td>
                                                <td >
                                                    <a href="" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
