@extends('layout.userlayout')

@section('title', 'ASA Hospitality')

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
                            Post Forget Password
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<!-- ======= Contact Single ======= -->
<section class="post-reg" id="post-reg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="post-reg-box">
                    <h5>Lupa Password Akun</h5>
                    <p>Silahkan cek email anda, untuk melanjutkan proses ubah password</p>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section><!-- End Contact Single-->

@endsection
