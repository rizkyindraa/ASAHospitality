@extends('layout.userlayout')

@section('title', 'Membership - ASA Hospitality')

@section('container')

<script>
    function send(id) {
        var selectedvalue = id;
        document.getElementById("membership").value = selectedvalue;
        console.log(selectedvalue);
    }

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
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
                        <li class="breadcrumb-item active" aria-current="page">
                            Membership
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<!-- ======= Pricing Section ======= -->
<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">

        <div class="row">
            @foreach($memberships as $membership)
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="box">
                    <h3>{{$membership->nama_membership}}</h3>
                    <h4><sup>Rp</sup>{{$membership->harga_membership}}<span> per {{$membership->periode}}
                            {{$membership->satuan_periode}}</span></h4>
                    <ul>
                        <li>Voucher Menginap {{$membership->jumlah_voucher}}x <i class="bi bi-check"></i> </li>
                        <li>Sharing Profit @if($membership->sharing_profit == 1) <i class="bi bi-check"></i> @else <i
                                class="bi bi-x"></i> @endif </li>
                        <li>Diskon Produk {{$membership->discount_product}}% <i class="bi bi-check"></i> </li>
                    </ul>
                    <a href="#register" onclick="send({{ $membership->id }});" class="buy-btn">Register</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section><!-- End Pricing Section -->

<!-- ======= Contact Single ======= -->
<section class="register" id="register">
    <div class="container">

        <div class="title-box-f mb-2">
            <h3 class="title-f" style="text-align: center">Register Membership</h3>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="register-box">
                    <p>Silahkan melakukan register membership disini</p>
                    <form action="{{route('store_member')}}" method="post" role="form" class="form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <input type="text" name="nama_depan"
                                        class="form-control form-control-lg form-control-a @error('nama_depan') is-invalid @enderror"
                                        placeholder="Nama Depan" required value="{{old('nama_depan')}}">
                                    @error('nama_depan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <input type="text" name="nama_belakang"
                                        class="form-control form-control-lg form-control-a @error('nama_belakang') is-invalid @enderror"
                                        placeholder="Nama Belakang" required value="{{old('nama_belakang')}}">
                                    @error('nama_belakang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select id="jenis_kelamin" name="jenis_kelamin"
                                    class="form-select form-control-lg form-control-a @error('jenis_kelamin') is-invalid @enderror"
                                    required>
                                    <option disabled value selected>Jenis Kelamin</option>
                                    <option value="laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <input name="no_hp" type="text"
                                        class="form-control form-control-lg form-control-a @error('no_hp') is-invalid @enderror"
                                        placeholder="No. Hp" required onkeypress="return hanyaAngka(event)"
                                        value="{{old('no_hp')}}">
                                    @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input name="email" type="text"
                                        class="form-control form-control-lg form-control-a @error('email') is-invalid @enderror"
                                        placeholder="Email" required value="{{old('email')}}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <input name="username" type="text"
                                        class="form-control form-control-lg form-control-a @error('username') is-invalid @enderror"
                                        placeholder="Username" required value="{{old('username')}}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <input name="password" type="password"
                                        class="form-control form-control-lg form-control-a @error('password') is-invalid @enderror"
                                        placeholder="Password" required value="{{old('password')}}">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <select id="membership" name="membership"
                                    class="form-select form-control-lg form-control-a @error('membership') is-invalid @enderror"
                                    required>
                                    <option disabled value selected>Membership</option>
                                    @foreach($memberships as $membership)
                                    <option value="{{$membership->id}}">{{$membership->nama_membership}}</option>
                                    @endforeach
                                </select>
                                @error('membership')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3 captcha">
                                <span>{!! captcha_img('flat') !!}</span>
                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    &#x21bb;
                                </button>
                            </div>
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <input name="captcha" type="text"
                                        class="form-control form-control-lg form-control-a @error('captcha') is-invalid @enderror"
                                        placeholder="Captcha" required>
                                    @error('captcha')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-a">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-box">
                    <p>Sudah pernah register? silahkan login</p>
                    @if (session('status'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{session('status')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form method="POST" role="form" class="form" action="{{route('member_postlogin')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input name="username" type="text"
                                        class="form-control form-control-lg form-control-a @error('username') is-invalid @enderror"
                                        placeholder="Username" required>
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <input name="password" type="password"
                                        class="form-control form-control-lg form-control-a @error('password') is-invalid @enderror"
                                        placeholder="Password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-a">Login</button>
                            </div>
                            <a class="forget-password text-center mt-2" href="{{route('forget_password')}}">Lupa
                                password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Contact Single-->

@endsection
