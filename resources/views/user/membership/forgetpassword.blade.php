@extends('layout.userlayout')

@section('title', 'Lupa Pasword - ASA Hospitality')

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
                            Forgot Password
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<!-- ======= Contact Single ======= -->
<section class="forget-password mb-4" id="forget-password">
    <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 email-forget-password-box">
                    <h5>Lupa Password Akun</h5>
                    <p>Mohon masukkan email anda, kemudian kami akan mengirimkan email untuk melakukan ubah password akun</p>
                    <form method="POST" role="form" class="form" action="{{route('post_forget_password')}}">
                        @csrf
                        <div class="form-group">
                            <input name="email" type="text"
                                class="form-control form-control-lg form-control-a @error('email') is-invalid @enderror"
                                placeholder="Email" required value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-2">
                                {{session('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-12 mt-3 text-center">
                            <button type="submit" class="btn btn-a">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3"></div>
            </div>
    </div>
</section><!-- End Contact Single-->

@endsection
