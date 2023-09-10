@extends('layout.userlayout')

@section('title', 'The Villa - ASA Hospitality')

@section('container')

<!-- ======= Intro Single ======= -->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">The Villa</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            The Villa
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<div class="title-box-e mt-5">
    <h3 class="title-e" style="text-align: center">{{$single_villa->nama_villa}}</h3>
    <p style="text-align: center; font-size: 20px; font-weight: bold;">{{$single_villa->subtitle}}</p>
</div>

<section class="property-single nav-arrow-b mt-3 mb-5">
    <div class="container">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div id="property-single-carousel" class="swiper">
                        <div class="swiper-wrapper">
                            @if(!$galleries->isEmpty())
                            @foreach($galleries as $gallery)
                            <div class="carousel-item-b swiper-slide">
                                <img src="{{asset('assets/'. $gallery->gallery)}}" alt="">
                            </div>
                            @endforeach
                            @else
                            <h5 style="text-align: center; font-weight: bold;">Tidak Ada Data</h5>
                            @endif
                        </div>
                    </div>
                    <div class="property-single-carousel-pagination carousel-pagination"></div>
                </div>
            </div>
        </div>

        <div class="row section-t3">
            <div class="col-lg-4">
                <div class="property-summary ">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-box-d">
                                <h3 class="title-d">Quick Summary</h3>
                            </div>
                        </div>
                    </div>
                    <div class="summary-list">
                        <ul class="list">
                            <li class="d-flex justify-content-between">
                                <strong>Villa Size</strong>
                                <span>{{$single_villa->size}} m<sup>2</sup>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <strong>Occupancy</strong>
                                <span>{{$single_villa->occupancy}}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <strong>Baths:</strong>
                                <span>{{$single_villa->bed_type}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box-d">
                            <h3 class="title-d">Description</h3>
                        </div>
                    </div>
                </div>
                <div class="property-description">
                    <p class="description color-text-a">
                        {{$single_villa->deskripsi}}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-amenities-tab" data-bs-toggle="pill" href="#pills-amenities" role="tab"
                        aria-controls="pills-amenities" aria-selected="true">Amenities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-video-tab" data-bs-toggle="pill" href="#pills-video" role="tab"
                        aria-controls="pills-video" aria-selected="true">Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" href="#pills-plans" role="tab"
                        aria-controls="pills-plans" aria-selected="false">Floor Plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-map-tab" data-bs-toggle="pill" href="#pills-map" role="tab"
                        aria-controls="pills-map" aria-selected="false">Ubication</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-amenities" role="tabpanel"
                    aria-labelledby="pills-amenities-tab">
                    <ul class="list-a">
                        @if(!$features->isEmpty())
                        @foreach($features as $feature)
                        <li>{{$feature->fitur}}</li>
                        @endforeach
                        @else
                        <h5 style="text-align: center; font-weight: bold;">Tidak Ada Data</h5>
                        @endif
                    </ul>
                </div>
                <div class="tab-pane fade" id="pills-video" role="tabpanel"
                    aria-labelledby="pills-video-tab">
                    <iframe width="100%" height="500" src="{{$single_villa->yt_link}}"
                        style="display: block; margin: auto;"></iframe>
                </div>
                <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
                    <img src="{{asset('assets/'. $single_villa->floor_plan)}}" alt="picture"
                        style="width:80%;display: block; margin: auto;">
                </div>
                <div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
                    <iframe src="{{$single_villa->ubication}}" width="100%" height="460" frameborder="0"
                        style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Property Single-->

<section class="section-property" style="background-color: #623b1a; padding: 50px 0 50px 0;">
    <div class="container">

        <div class="title-box-f mb-5">
            <h3 class="title-f" style="text-align: center">Other Villas</h3>
        </div>

        <div id="property-carousel" class="swiper">
            <div class="swiper-wrapper">
                @if(!$other_villas->isEmpty())
                @foreach($other_villas as $villa)
                <div class="carousel-item-b swiper-slide">
                    <div class="card-box-a card-shadow">
                        <div class="img-box-a">
                            <img src="{{asset('assets/'. $villa->display)}}" alt="" class="img-a img-fluid">
                        </div>
                        <div class="card-overlay">
                            <div class="card-overlay-a-content">
                                <div class="card-header-a">
                                    <h2 class="card-title-a">
                                        <a href="{{url('villa-list', $villa->id)}}">{{$villa->nama_villa}}
                                    </h2>
                                    <p style="color: #fff">{{$villa->subtitle}}</p>
                                </div>
                                <div class="card-body-a">
                                    <a href="{{url('villa-list', $villa->id)}}" class="link-a">Detail
                                        <span class="bi bi-chevron-right"></span>
                                    </a>
                                </div>
                                <div class="card-footer-a">
                                    <ul class="card-info d-flex justify-content-around">
                                        <li>
                                            <h4 class="card-info-title">Villa Size</h4>
                                            <span>{{$villa->size}} m<sup>2</sup>
                                            </span>
                                        </li>
                                        <li>
                                            <h4 class="card-info-title">Occupancy</h4>
                                            <span>{{$villa->occupancy}}</span>
                                        </li>
                                        <li>
                                            <h4 class="card-info-title">Bed Type</h4>
                                            <span>{{$villa->bed_type}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End carousel item -->
                @endforeach
                @else
                <h5 style="text-align: center; font-weight: bold;">Tidak Ada Data</h5>
                @endif

            </div>
        </div>
    </div>
</section><!-- End Latest Properties Section -->



@endsection
