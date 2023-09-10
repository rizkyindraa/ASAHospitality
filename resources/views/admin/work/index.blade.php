@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | How We Work')

@section('container')

<div class="pagetitle">
    <h1>Daftar Konten How We Work</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="">
                              <input type="text" name="cari" placeholder="Cari" title="Enter search keyword">
                              <a type="submit" href="{{route('work')}}" class="btn-refresh" title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                              <button type="submit" class="btn-search" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="" class="btn btn-primary mb-2" style="float:right;" data-bs-toggle="modal"
                            data-bs-target="#tambah">Tambah <i class="bi bi-plus-square"></i></a>
                        </div>
                    </div>

                    <div class="modal fade" id="tambah" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah How We Work</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" method="POST" action="{{ route('store_work') }}">
                                        @csrf
                                        <div class="col-md-12">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title"
                                                placeholder="Masukkan Title"
                                                value="{{old('title')}}" required>
                                            @error('title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label for="subtitle" class="form-label">Subtitle</label>
                                            <textarea class="form-control @error('subtitle') is-invalid @enderror"
                                                id="subtitle" name="subtitle"
                                                placeholder="Masukkan Subtitle"
                                                required>{{old('subtitle')}}</textarea>
                                            @error('subtitle')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                                </form>
                            </div>
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
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data How We Work</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Ttile</th>
                                <th scope="col" style="text-align:center;width:500px;">Subtitle</th>
                                <th scope="col" style="text-align:center;width:109px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$works->isEmpty())
                            @foreach($works as $work)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$work->title}}</td>
                                <td>{{$work->subtitle}}</td>
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-warning" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#edit{{$work->id}}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{url('delete_work', $work->id)}}" class="badge bg-danger" style="width: 40px;"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{$work->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit How We Work</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{url('update_work', $work->id)}}">
                                                @method('patch')
                                                {{csrf_field()}}
                                                <div class="col-md-12 mt-2">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        id="title" name="title"
                                                        placeholder="Masukkan Nama Membership"
                                                        value="{{$work->title}}" required>
                                                    @error('title')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mt-2">
                                                        <label for="subtitle" class="form-label">Subtitle</label>
                                                        <textarea class="form-control @error('subtitle') is-invalid @enderror"
                                                            id="subtitle" name="subtitle"
                                                            placeholder="Masukkan Harga Membership" required>{{$work->subtitle}}</textarea>
                                                        @error('subtitle')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- End Edit Modal -->

                            @endforeach
                            @else
                            <td colspan="4" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$works->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection