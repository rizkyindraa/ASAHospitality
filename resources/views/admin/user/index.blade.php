@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Admin Management')

@section('container')

<div class="pagetitle">
    <h1>Daftar User</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="{{route('admin_search')}}">
                                <input type="text" name="cari" placeholder="Cari" title="Enter search keyword">
                                <a type="submit" href="{{route('admin')}}" class="btn-refresh" title="Search"><i
                                        class="bi bi-arrow-clockwise"></i></a>
                                <button type="submit" class="btn-search" title="Search"><i
                                        class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="{{route('create_admin')}}" class="btn btn-primary mb-2" style="float:right;">Tambah
                                <i class="bi bi-plus-square"></i></a>
                        </div>
                    </div>

                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session('status')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{session('delete')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data User</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Username</th>
                                <th scope="col" style="text-align:center;width:400px;">Email</th>
                                <th scope="col" style="text-align:center;width:100px;">Role</th>
                                <th scope="col" style="text-align:center;width:100px;">Status</th>
                                <th scope="col" style="text-align:center;width:109px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$users->isEmpty())
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->username}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td style="text-align: center">
                                    @if($user->status == 1)
                                        <a href="{{url('status_admin', $user->id)}}" class="badge bg-success" style="width: 60px;">Aktif</a>
                                    @else
                                        <a href="{{url('status_admin', $user->id)}}" class="badge bg-danger" style="width: 80px;">Non-Aktif</a>
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{url('edit_admin', $user->id)}}" class="badge bg-warning" style="width: 40px;"><i class="bi bi-pencil-square"></i></a>
                                    <a href="" class="badge bg-danger" style="width: 40px;" data-bs-toggle="modal" data-bs-target="#delete{{$user->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="delete{{$user->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus data ini?</p>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Username</label>
                                                    <p>{{$user->username}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Email</label>
                                                    <p>{{$user->email}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{url('delete_admin', $user->id)}}" class="btn btn-danger">Delete</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Modal Validation -->
                            @endforeach
                            @else
                            <td colspan="6" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
