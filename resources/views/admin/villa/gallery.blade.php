@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Villa')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>List Fitur</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('villa')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
                    class="bi bi-backspace"></i></a>
        </div>
    </div>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">

                    <table class="mb-3">
                        <tbody>
                            <tr>
                                <td style="width: 200px;">Nama Villa</td>
                                <td style="width: 30px;">:</td>
                                <td style="width: 500px;">{{$single_villa->nama_villa}}</td>
                            </tr>
                            <tr>
                                <td>Subtitle</td>
                                <td>:</td>
                                <td>{{$single_villa->subtitle}}</td>
                            </tr>
                            <tr>
                                <td>Size</td>
                                <td>:</td>
                                <td>{{$single_villa->size}} m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <td>Occupancy</td>
                                <td>:</td>
                                <td>{{$single_villa->occupancy}} m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <td>Bed Type</td>
                                <td>:</td>
                                <td>{{$single_villa->bed_type}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="" class="btn btn-primary mb-1" style="float:right;" data-bs-toggle="modal"
                            data-bs-target="#features_create">Tambah <i class="bi bi-plus-square"></i></a>
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

                    <div class="modal fade" id="features_create" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Gallery</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" method="POST" action="{{url('store_gallery', $villa)}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-12">
                                            <label for="gallery" class="form-label">Gambar <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 1920x1080"></i></label>
                                            <input type="file"
                                                class="form-control @error('gallery') is-invalid @enderror"
                                                id="gallery" name="gallery" required>
                                            @error('gallery')
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
                                </form><!-- End Multi Columns Form -->
                            </div>
                        </div>
                    </div> <!-- End Modal Validation -->

                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Gallery</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Gallery</th>
                                <th scope="col" style="text-align:center;width:109px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$galleries->isEmpty())
                            @foreach($galleries as $gallery)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td><img src="{{asset('assets/'. $gallery->gallery)}}" alt="picture" style="width:20%;"></td>
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-warning" style="width: 40px;" data-bs-toggle="modal"
                                    data-bs-target="#features_edit{{$gallery->id}}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{url('delete_gallery', $gallery->id)}}" class="badge bg-danger" style="width: 40px;"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="features_edit{{$gallery->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Fitur</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST" action="{{url('update_gallery', $gallery->id)}}" enctype="multipart/form-data">
                                                @method('patch')
                                                @csrf
                                                <img src="{{asset('assets/'. $gallery->gallery)}}" alt="picture" style="width:50%; display: block; margin: auto;" class="mt-3">
                                                <div class="col-md-12 mt-3">
                                                    <label for="gallery" class="form-label">Gambar <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 1920x1080"></i></label>
                                                    <input type="file"
                                                        class="form-control @error('gallery') is-invalid @enderror"
                                                        id="gallery" name="gallery" required>
                                                    @error('gallery')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </div>
                                        </form><!-- End Multi Columns Form -->
                                    </div>
                                </div>
                            </div> <!-- End Modal Validation -->

                            @endforeach
                            @else
                            <td colspan="3" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$galleries->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection