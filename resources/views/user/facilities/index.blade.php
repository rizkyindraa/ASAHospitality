@extends('layout.userlayout')

@section('title', 'Facilities - ASA Hospitality')

@section('container')

<!-- ======= Intro Single ======= -->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">Facilities</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Facilities
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<!-- ======= Services Section ======= -->
<section id="service" class="services mb-5 mt-5">
    <div class="container" data-aos="fade-up">

        <div class="title-box-e mb-5">
            <h3 class="title-e" style="text-align: center">Our Facilities</h3>
        </div>

        <div class="row gy-4 justify-content-center">
            @if(!$facilities->isEmpty())
            @foreach($facilities as $facility)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-img">
                        <img src="{{asset('assets/'. $facility->facilities_picture)}}" alt="" class="img-fluid">
                    </div>
                    <h3>{{$facility->facilities_name}}</h3>
                    <p>{{$facility->subtitle}}</p>
                </div>
            </div><!-- End Card Item -->
            @endforeach
            @else
            <h5 style="text-align: center; font-weight: bold;">Tidak Ada Data</h5>
            @endif
        </div>

    </div>
</section><!-- End Services Section -->
