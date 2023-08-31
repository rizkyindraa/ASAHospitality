@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Slider')

@section('container')

<div class="pagetitle">
    <h1>Daftar Slider</h1>
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
                              <input type="text" name="cari" placeholder="Cari Dari Nama Membership" title="Enter search keyword">
                              <a type="submit" href="{{route('slider')}}" class="btn-refresh" title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                              <button type="submit" class="btn-search" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="{{route('create_slider')}}" class="btn btn-primary mb-2" style="float:right;">Tambah <i class="bi bi-plus-square"></i></a>
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
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Jenis Membership</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Title</th>
                                <th scope="col" style="text-align:center;width:300px;">Sub Title</th>
                                <th scope="col" style="text-align:center;width:40px;">Gambar</th>
                                <th scope="col" style="text-align:center;width:109px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$sliders->isEmpty())
                            @foreach($sliders as $slider)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->subtitle}}</td>
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-primary" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#gambar{{$slider->id}}"><i
                                        class="bi bi-images"></i></a></td>
                                <td style="text-align:center;">
                                    <a href="/update_slider/{{$slider->id}}" class="badge bg-warning" style="width: 40px;"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="" class="badge bg-danger" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#delete{{$slider->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="gambar{{$slider->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Gambar Slider</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="col-md-12 mt-2">
                                                    <img src="{{asset('assets/'.$slider->slider_picture)}}" style="width: 70%; display: block; margin: auto;" alt="Profile">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Modal Validation -->

                            <div class="modal fade" id="delete{{$slider->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Slider</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus data ini?</p>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Title</label>
                                                    <p>{{$slider->title}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Subtitle</label>
                                                    <p>{{$slider->subtitle}}</p>
                                                </div>
                                            </div>
                                                <div class="col-md-12 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Background Image</label>
                                                    <br>
                                                    <img src="{{asset('assets/'.$slider->slider_picture)}}" style="width: 50%" alt="Profile">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{url('delete_slider', $slider->id)}}"
                                                class="btn btn-danger">Delete</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Modal Validation -->
                            @endforeach
                            @else
                            <td colspan="8" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$sliders->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection