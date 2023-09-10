@extends('layout.userlayout')

@section('title', 'About Us - ASA Hospitality')

@section('container')

<!-- ======= Intro Single ======= -->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">About Us</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            About Us
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<section id="cta" class="cta mt-5 mb-5">
    <div class="container" data-aos="zoom-out">

        <div class="row g-5">

            <div class="col-lg-6 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
                <h3>{{$about->title}}</h3>
                <p>{{$about->post}}</p>
            </div>

            <div class="col-lg-6 col-md-6 order-first order-md-last d-flex align-items-center">
                <div class="img">
                    <img src="{{asset('assets/'. $about->about_picture)}}" alt="" class="img-fluid">
                </div>
            </div>

        </div>

    </div>
</section>


@endsection
