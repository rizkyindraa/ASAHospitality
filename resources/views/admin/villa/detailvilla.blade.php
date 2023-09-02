@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Villa')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Detail Villa</h1>
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

                    <img src="{{asset('assets/'. $single_villa->display)}}" alt="picture" style="width:20%;display: block; margin: auto;">

                    <table class="mb-3 mt-3">
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
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <textarea type="text" class="form-control @error('fitur') is-invalid @enderror" id="fitur" name="fitur" disabled>{{$single_villa->deskripsi}}</textarea>

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
                            <iframe width="100%" height="500" src="{{$single_villa->yt_link}}"
                                style="display: block; margin: auto;"></iframe>
                        </div>
                        <div class="tab-pane fade" id="bordered-floor" role="tabpanel" aria-labelledby="profile-tab">
                            <img src="{{asset('assets/'. $single_villa->floor_plan)}}" alt="picture"
                                style="width:80%;display: block; margin: auto;">
                        </div>
                        <div class="tab-pane fade" id="bordered-ubication" role="tabpanel"
                            aria-labelledby="contact-tab">
                            <iframe src="{{$single_villa->ubication}}" width="100%" height="460" frameborder="0"
                                style="border:0" allowfullscreen></iframe>
                        </div>
                    </div><!-- End Bordered Tabs -->

                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold; margin-top: 10px;">List Data
                        Fitur</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Fitur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$features->isEmpty())
                            @foreach($features as $feature)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$feature->fitur}}</td>
                            </tr>
                            @endforeach
                            @else
                            <td colspan="2" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{$features->links()}}
                    </div>

                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold; margin-top: 10px;">List Gallery
                    </p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Gallery</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$galleries->isEmpty())
                            @foreach($galleries as $gallery)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td><img src="{{asset('assets/'. $gallery->gallery)}}" alt="picture" style="width:20%;">
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td colspan="2" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{$galleries->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
