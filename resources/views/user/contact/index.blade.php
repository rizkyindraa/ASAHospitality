@extends('layout.userlayout')

@section('title', 'Contact Us - ASA Hospitality')

@section('container')

<!-- ======= Intro Single ======= -->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">Contact Us</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            Contact Us
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<div class="title-box-e mt-5">
    <h3 class="title-e" style="text-align: center">Contact Us</h3>
</div>

<section class="contact mb-5">
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <div class="row">

                    <div class="col-sm-6 section-t3">
                        <div class="icon-box section-b2">
                            <div class="icon-box-icon">
                                <span class="bi bi-telephone"></span>
                            </div>
                            <div class="icon-box-content table-cell">
                                <div class="icon-box-title">
                                    <h4 class="icon-title">Call Us</h4>
                                </div>
                                <div class="icon-box-content">
                                    <p class="mb-1">Phone.
                                        <span class="color-a">+62{{$contact->phone}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 section-t3">
                        <div class="icon-box section-b2">
                            <div class="icon-box-icon">
                                <span class="bi bi-envelope"></span>
                            </div>
                            <div class="icon-box-content table-cell">
                                <div class="icon-box-title">
                                    <h4 class="icon-title">Say Hello</h4>
                                </div>
                                <div class="icon-box-content">
                                    <p class="mb-1">Email.
                                        <span class="color-a">{{$contact->email}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 section-t3">
                        <div class="icon-box section-b2">
                            <div class="icon-box-icon">
                                <span class="bi bi-building"></span>
                            </div>
                            <div class="icon-box-content table-cell">
                                <div class="icon-box-title">
                                    <h4 class="icon-title">Hang With Us</h4>
                                </div>
                                <div class="icon-box-content">
                                    <p class="mb-1">Office Address.
                                        <span class="color-a">{{$contact->office_address}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 section-t3">
                        <div class="icon-box section-b2">
                            <div class="icon-box-icon">
                                <span class="bi bi-house"></span>
                            </div>
                            <div class="icon-box-content table-cell">
                                <div class="icon-box-title">
                                    <h4 class="icon-title">Check Our Properties</h4>
                                </div>
                                <div class="icon-box-content">
                                    <p class="mb-1">Villa Address.
                                        <span class="color-a">{{$contact->villa_address}}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
            </div>

            <div class="col-sm-6">
                <div class="contact-map box">
                    <div id="map" class="contact-map">
                        <iframe src="{{$contact->map}}" width="100%" height="450" frameborder="0" style="border:0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section><!-- End Contact Single-->



@endsection
