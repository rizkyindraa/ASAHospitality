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

<section class="about mb-5 mt-2">
    <div class="container">
        <div class="title-box-e mb-5">
            <h3 class="title-e" style="text-align: center">{{$about->title}}</h3>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="about-img">
                    <img src="{{asset('assets/'. $about->about_picture)}}" class="about-pic">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="about-post">
                    <p style="font-weight:bold; overflow: visible; overflow-wrap:anywhere;">
                        {{$about->post}}
                    </p>
                </div>
            </div>
        </div>
        
    </div>
</section>


@endsection
