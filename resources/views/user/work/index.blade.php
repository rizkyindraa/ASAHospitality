@extends('layout.userlayout')

@section('title', 'How We Work - ASA Hospitality')

@section('container')

<!-- ======= Intro Single ======= -->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">How We Work</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            How We Work
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<!-- Faq Section - Home Page -->
<section id="faq" class="faq mt-5 mb-5">
    <div class="container">

        <div class="title-box-e mb-5" data-aos="fade-up">
            <h3 class="title-e" style="text-align: center">How We Work</h3>
        </div>
        
        <div class="col-lg-12" data-aos="fade-up">

            <div class="faq-container">
                @if(!$works->isEmpty())
                @foreach($works as $work)
                <div class="faq-item">
                    <h3><span class="num">{{$loop->iteration}}. </span> <span>{{$work->title}}</span>
                    </h3>
                    <div class="faq-content">
                        <p>{{$work->subtitle}}</p>
                    </div>
                    <i class="faq-toggle bi bi-chevron-right"></i>
                </div>
                @endforeach
                @else
                <h5 style="text-align: center; font-weight: bold;">Tidak Ada Data</h5>
                @endif
            </div>

        </div>

    </div>
</section>


@endsection
