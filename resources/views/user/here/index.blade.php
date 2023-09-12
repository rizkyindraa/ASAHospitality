@extends('layout.userlayout')

@section('title', 'How to Get Here - ASA Hospitality')

@section('container')

<!-- ======= Intro Single ======= -->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">How to Get Here</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            How to Get Here
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<section id="features" class="features mb-5">
    <div class="container">
        @if(!$ways->isEmpty())
        @foreach($ways as $way)
        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
            <div class="col-md-6">
                <img src="{{asset('assets/'. $way->way_picture)}}" class="img-fluid" alt="">
            </div>
            <div class="col-md-6">
                <h3>{{$way->way_name}}</h3>
                <p>{{$way->subtitle}}</p>
                {!!$way->description!!}
            </div>
        </div><!-- Features Item -->
        @endforeach
        @else
        <h5 style="text-align: center; font-weight: bold;">Tidak Ada Data</h5>
        @endif
    </div>
</section><!-- End Features Section -->

@endsection
