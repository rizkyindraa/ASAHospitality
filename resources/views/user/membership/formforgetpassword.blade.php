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
                            Edit Password
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section><!-- End Intro Single-->

<!-- ======= Contact Single ======= -->
<section class="forget-password" id="forget-password">
    <div class="container">
        <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-center">
                <div class="title-box">
                    <h2 class="title-a">Ubah Password Akun</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="email-forget-password-box">
                    <h5>Informasi Akun</h5>
                    <p>Request ubah password untuk akun dengan informasi</p>
                    <img src="{{asset('assets/'.$user->pp_path)}}" alt="Profile" class="forget-password-img">
                    <div class="row">
                        <div class="col-md-6 mt-4 forget-password-info">
                            <label for="inputName5" class="form-label fw-bold">Email</label>
                            <p>{{$user->email}}</p>
                        </div>
                        <div class="col-md-6 mt-4 forget-password-info">
                            <label for="inputName5" class="form-label fw-bold">Username</label>
                            <p>{{$user->username}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4 forget-password-info">
                            <label for="inputName5" class="form-label fw-bold">Nama</label>
                            <p>{{$member->nama_depan}} {{$member->nama_belakang}}</p>
                        </div>
                        <div class="col-md-6 mt-4 forget-password-info">
                            <label for="inputName5" class="form-label fw-bold">Jenis Kelamin</label>
                            @if($member->jenis_kelamin == 'laki')
                            <p>Laki-Laki</p>
                            @else
                            <p>Perempuan</p>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4 forget-password-info">
                            <label for="inputName5" class="form-label fw-bold">Tgl. Registrasi</label>
                            <p>{{Carbon\Carbon::parse($reg->tgl_registrasi)->isoFormat('dddd, D MMMM Y')}}</p>
                        </div>
                        <div class="col-md-6 mt-4 forget-password-info">
                            <label for="inputName5" class="form-label fw-bold">No. Registrasi</label>
                            <p>{{$reg->no_registrasi}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="email-forget-password-box">
                    <h5>Ubah Password</h5>
                    <p>Silahkan masukkan password baru anda, pastikan anda menyimpan password baru</p>
                    <form method="POST" role="form" class="form" action="/membership/forget-password/edit-password/{{ $user->id }}/{{$token}}">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <input name="password" type="password"
                                class="form-control form-control-lg form-control-a @error('password') is-invalid @enderror"
                                placeholder="Password Baru" required value="{{old('password')}}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <input name="password_confirmation" type="password"
                                class="form-control form-control-lg form-control-a @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm Password" required value="{{old('password_confirmation')}}">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3 text-center">
                            <button type="submit" class="btn btn-a">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Contact Single-->

@endsection
