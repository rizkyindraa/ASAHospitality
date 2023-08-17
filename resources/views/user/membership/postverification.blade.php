@extends('layout.userlayout')

@section('title', 'ASA Hospitality')

@section('container')

<script>
    function send(id) {
        var selectedvalue = id;
        document.getElementById("membership").value = selectedvalue;
        console.log(selectedvalue);
    }

</script>

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
<section class="post-reg" id="post-reg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="post-reg-box">
                    <h5>Verifikasi Email Sukses</h5>
                    <p>{{session('message')}}</p>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section><!-- End Contact Single-->

@endsection
