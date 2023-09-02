@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Villa')

@section('container')

<div class="pagetitle">
    <h1>Daftar Villa</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="{{route('villa_search')}}">
                              <input type="text" name="cari" placeholder="Cari" title="Enter search keyword">
                              <a type="submit" href="{{route('villa')}}" class="btn-refresh" title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                              <button type="submit" class="btn-search" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="{{route('create_villa')}}" class="btn btn-primary mb-2" style="float:right;">Tambah <i class="bi bi-plus-square"></i></a>
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
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Villa</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Nama Villa</th>
                                <th scope="col" style="text-align:center;width:400px;">Subtitle</th>
                                <th scope="col" style="text-align:center;width:40px;">Fitur</th>
                                <th scope="col" style="text-align:center;width:40px;">Gallery</th>
                                <th scope="col" style="text-align:center;width:160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$villas->isEmpty())
                            @foreach($villas as $villa)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$villa->nama_villa}}</td>
                                <td>{{$villa->subtitle}}</td>
                                <td style="text-align:center;">
                                    <a href="/villa/fitur/{{$villa->id}}" class="badge bg-primary" style="width: 40px;"><i
                                        class="bi bi-eye"></i></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="/villa/gallery/{{$villa->id}}" class="badge bg-primary" style="width: 40px;"><i
                                        class="bi bi-eye"></i></a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{url('detail_villa', $villa->id)}}" class="badge bg-primary" style="width: 40px;"><i
                                        class="bi bi-eye"></i></a>
                                    <a href="{{url('edit_villa', $villa->id)}}" class="badge bg-warning" style="width: 40px;"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="" class="badge bg-danger" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#delete{{$villa->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="delete{{$villa->id}}" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Villa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus data ini?</p>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p>Nama Villa</p>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p>: {{$villa->nama_villa}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p>Subtitle</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <p>: {{$villa->subtitle}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p>Size</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <p>: {{$villa->size}} m<sup>2</sup></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p>Occupancy</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <p>: {{$villa->occupancy}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p>Bed Type</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <p>: {{$villa->bed_type}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <p>Deskripsi</p>
                                                </div>
                                                <div class="col-lg-10">
                                                    <p>: </p>
                                                </div>
                                            </div>

                                            <textarea type="text" class="form-control @error('fitur') is-invalid @enderror" id="fitur" name="fitur" disabled>{{$villa->deskripsi}}</textarea>
                                            
                                            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                        data-bs-target="#bordered-yt" type="button" role="tab" aria-controls="home"
                                                        aria-selected="true">Youtube Link</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                        data-bs-target="#bordered-floor" type="button" role="tab" aria-controls="profile"
                                                        aria-selected="false">Floor Plan</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                        data-bs-target="#bordered-ubication" type="button" role="tab" aria-controls="contact"
                                                        aria-selected="false">Ubication</button>
                                                </li>
                                            </ul>
                        
                                            <div class="tab-content pt-2" id="borderedTabContent">
                                                <div class="tab-pane fade show active" id="bordered-yt" role="tabpanel"
                                                    aria-labelledby="home-tab">
                                                    <iframe width="100%" height="500" src="{{$villa->yt_link}}"
                                                        style="display: block; margin: auto;"></iframe>
                                                </div>
                                                <div class="tab-pane fade" id="bordered-floor" role="tabpanel" aria-labelledby="profile-tab">
                                                    <img src="{{asset('assets/'. $villa->floor_plan)}}" alt="picture"
                                                        style="width:80%;display: block; margin: auto;">
                                                </div>
                                                <div class="tab-pane fade" id="bordered-ubication" role="tabpanel"
                                                    aria-labelledby="contact-tab">
                                                    <iframe src="{{$villa->ubication}}" width="100%" height="460" frameborder="0"
                                                        style="border:0" allowfullscreen></iframe>
                                                </div>
                                            </div><!-- End Bordered Tabs -->

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{url('delete_villa', $villa->id)}}"
                                                class="btn btn-danger">Delete</i></a>
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
                    {{$villas->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection