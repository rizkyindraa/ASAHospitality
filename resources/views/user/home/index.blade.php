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
            <div class="col-lg-6" style="padding: 50px">
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
            <div class="col-lg-6" style="position: relative;">
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
            <div class="title-box-e">
                <h3 class="title-e" style="text-align: center">Company Overview</h3>
            </div>
            <div class="col-lg-12 flyer">
                <img src="{{asset('assets/'. $greeting->greeting_picture)}}" class="overview-pic">
            </div>
            <div class="col-lg-12 subtitle">
                <p>
                    PT ASA Svargaloka Rinjani didirikan bersama pada tahun 2022 di Lombok, Nusa Tenggara Barat.
                    Dengan melihat potensi besar dari Lombok di bidang ekonomi, pariwisata dan keindahan serta kekayaan
                    alamnya. Juga didorong oleh dibangunnya Destinasi Wisata Super Prioritas, Sirkuit Mandalika. Kami
                    bertekad mendorong kemajuan ekonomi dan pariwisata Lombok dengan membangun kawasan Villa yang
                    mengusung konsep keseimbangan yang berkelanjutan antara Manusia dan Alam.
                </p>
            </div>

        </div>
</section>

@endsection
