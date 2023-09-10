@extends('layout.userlayout')

@section('title', 'Registrasi Membership - ASA Hospitality')

@section('container')

<!-- ======= Intro Single ======= -->
<section class="intro-single">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <div class="title-single-box">
                    <h1 class="title-single">Memberships Plan</h1>
                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{route('membership')}}">Membership</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Post Registration
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<!-- ======= Contact Single ======= -->
<section class="post-reg mb-4" id="post-reg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="post-reg-box">
                    <h5>Registrasi Membership Berhasil</h5>
                    <p>Silahkan melakukan verifikasi email, untuk melanjutkan proses registrasi</p>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section><!-- End Contact Single-->

@endsection
