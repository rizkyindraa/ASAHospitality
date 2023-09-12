@extends('layout.userlayout')

@section('title', 'ASA Hospitality')

@section('container')

<!-- ======= Intro Section ======= -->
<div class="intro intro-carousel swiper position-relative">

    <div class="swiper-wrapper">
        @foreach($sliders as $slider)
        <div class="swiper-slide carousel-item-a intro-item bg-image"
            style="background-image: url('{{asset('assets/'. $slider->slider_picture)}}');">
            <div class="overlay overlay-a"></div>
            <div class="intro-content display-table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="intro-body">
                                    <p class="intro-title-top">{{$slider->subtitle}} </p>
                                    <h1 class="intro-title mb-4 ">
                                        {{$slider->title}}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div><!-- End Intro Section -->

<!-- ======= About Section ======= -->
<section class="section-abouts">
    <div class="container">

        <div class="row pt-5 pb-5">
            <div class="col-lg-6" style="padding: 50px" data-aos="fade-right">
                <div class="title-box-dx mt-5">
                    <h3 class="title-dx" style="text-align: center">{{$greeting->title}}</h3>
                </div>
                <p class="color-text-a"
                    style="text-align: center; font-weight:bold; overflow: visible; overflow-wrap:anywhere;">
                    {{$greeting->subtitle}}
                </p>
                <div class="col-md-12 text-center">
                    <a href="{{asset('assets/'. $greeting->greeting_file)}}" target="_blank" class="btn btn-a">Click
                        Here</a>
                </div>
            </div>
            <div class="col-lg-6" style="position: relative;" data-aos="fade-left">
                <img src="{{asset('assets/'. $greeting->greeting_picture)}}" class="welcome-pic">
                <a href="{{$greeting->yt_link}}" class="glightbox btn-watch-video d-flex align-items-center">
                    <i class="bi bi-play-circle"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ======= About Section ======= -->
<section class="section-overview">
    <div class="container">
        <div class="col-lg-12 overview-box">
            <div class="title-box-e" data-aos="fade-up">
                <h3 class="title-e" style="text-align: center">{{$overview->title}}</h3>
            </div>
            <div class="col-lg-12 flyer" data-aos="fade-up">
                <img src="{{asset('assets/'. $overview->overview_picture)}}" class="overview-pic">
            </div>
            <div class="col-lg-12 subtitle" data-aos="fade-up">
                    {!!$overview->subtitle!!}
            </div>

        </div>
</section>

<section class="section-property section-t8">
    <div class="container">

        <div class="title-box-e mb-5" data-aos="fade-up">
            <h3 class="title-e" style="text-align: center">The Villas</h3>
        </div>

        <div id="property-carousel" class="swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                @if(!$villas->isEmpty())
                @foreach($villas as $villa)
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
        <div class="propery-carousel-pagination carousel-pagination"></div>
    </div>
</section><!-- End Latest Properties Section -->

<section id="team" class="team section-t8 mb-5">

    <div class="container">

        <div class="title-box-e mb-5">
            <h3 class="title-e" style="text-align: center">Team</h3>
        </div>

        <div class="row gy-5 justify-content-center">
            @if(!$teams->isEmpty())
            @foreach($teams as $team)
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                <div class="member-img">
                    <img src="{{asset('assets/'. $team->foto)}}" class="img-fluid" alt="">
                    <div class="social">
                        <a href="{{$team->tw_link}}" target="_blank"><i class="bi bi-twitter"></i></a>
                        <a href="{{$team->fb_link}}" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="{{$team->ig_link}}" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="{{$team->li_link}}" target="_blank"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="member-info text-center">
                    <h4>{{$team->nama}}</h4>
                    <span>{{$team->posisi}}</span>
                    <p>{{$team->email}}</p>
                </div>
            </div><!-- End Team Member -->
            @endforeach
            @else
            <h5 style="text-align: center; font-weight: bold;">Tidak Ada Data</h5>
            @endif
        </div>

    </div>

</section><!-- End Team Section -->

@endsection
