@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Team')

@section('container')

<div class="pagetitle">
    <h1>Daftar Team</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="{{route('team_search')}}">
                                <input type="text" name="cari" placeholder="Cari" title="Enter search keyword">
                                <a type="submit" href="{{route('team')}}" class="btn-refresh" title="Search"><i
                                        class="bi bi-arrow-clockwise"></i></a>
                                <button type="submit" class="btn-search" title="Search"><i
                                        class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="{{route('create_team')}}" class="btn btn-primary mb-2" style="float:right;">Tambah
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
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Team</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Nama</th>
                                <th scope="col" style="text-align:center;width:300px;">Email</th>
                                <th scope="col" style="text-align:center;width:150px;">No. HP</th>
                                <th scope="col" style="text-align:center;width:150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$teams->isEmpty())
                            @foreach($teams as $team)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$team->nama}}</td>
                                <td>{{$team->email}}</td>
                                <td>+62{{$team->no_hp}}</td>
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-primary" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#detail{{$team->id}}"><i class="bi bi-eye"></i></a>
                                    <a href="{{url('edit_team', $team->id)}}" class="badge bg-warning"
                                        style="width: 40px;"><i class="bi bi-pencil-square"></i></a>
                                    <a href="" class="badge bg-danger" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#delete{{$team->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="detail{{$team->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Team</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-126 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Nama</label>
                                                <p>{{$team->nama}}</p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Posisi</label>
                                                <p>{{$team->posisi}}</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Email</label>
                                                    <p>{{$team->email}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">No. Hp</label>
                                                    <p>+62{{$team->no_hp}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link
                                                    Instagram</label>
                                                <p><a target="_blank" href="{{$team->ig_link}}">{{$team->ig_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link Facebook</label>
                                                <p><a target="_blank" href="{{$team->fb_link}}">{{$team->fb_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link Twitter</label>
                                                <p><a target="_blank" href="{{$team->tw_link}}">{{$team->tw_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link LinkedIn</label>
                                                <p><a target="_blank" href="{{$team->li_link}}">{{$team->li_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Foto</label>
                                                <br>
                                                <img src="{{asset('assets/'. $team->foto)}}" style="width: 50%"
                                                    alt="Profile">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Modal Validation -->

                            <div class="modal fade" id="delete{{$team->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Team</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus data ini?</p>
                                            <div class="col-md-126 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Nama</label>
                                                <p>{{$team->nama}}</p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Posisi</label>
                                                <p>{{$team->posisi}}</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Email</label>
                                                    <p>{{$team->email}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">No. Hp</label>
                                                    <p>+62{{$team->no_hp}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link
                                                    Instagram</label>
                                                <p><a target="_blank" href="{{$team->ig_link}}">{{$team->ig_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link Facebook</label>
                                                <p><a target="_blank" href="{{$team->fb_link}}">{{$team->fb_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link Twitter</label>
                                                <p><a target="_blank" href="{{$team->tw_link}}">{{$team->tw_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Link LinkedIn</label>
                                                <p><a target="_blank" href="{{$team->li_link}}">{{$team->li_link}}</a>
                                                </p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Foto</label>
                                                <br>
                                                <img src="{{asset('assets/'. $team->foto)}}" style="width: 50%"
                                                    alt="Profile">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{url('delete_team', $team->id)}}" class="btn btn-danger">Delete</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Modal Validation -->
                            @endforeach
                            @else
                            <td colspan="5" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$teams->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
