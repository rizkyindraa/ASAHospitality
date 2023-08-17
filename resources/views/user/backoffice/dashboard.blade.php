@extends('layout.useradminlayout')

@section('title', 'ASA Hospitality | Dashboard')

@section('container')

<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

</script>

<div class="pagetitle">
    <h1>Dashboard</h1>
</div><!-- End Page Title -->

<section class="section profile">
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
        {{session('status')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{asset('assets/'.auth()->user()->pp_path)}}" alt="Profile" class="rounded-circle">
                    <h2>{{$member->nama_depan}} {{$member->nama_belakang}}</h2>
                    <h3>Member</h3>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#profile-change-password">Change Password</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                            <h5 class="card-title">Profile</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama</div>
                                <div class="col-lg-9 col-md-8">{{$member->nama_depan}} {{$member->nama_belakang}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8">{{auth()->user()->email}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Verifikasi Email</div>
                                <div class="col-lg-9 col-md-8">
                                    {{Carbon\Carbon::parse(auth()->user()->email_verified_at)->isoFormat('dddd, D MMMM Y')}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Username</div>
                                <div class="col-lg-9 col-md-8">{{auth()->user()->username}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                @if($member->jenis_kelamin == 'laki')
                                <div class="col-lg-9 col-md-8">Laki-Laki</div>
                                @else
                                <div class="col-lg-9 col-md-8">Perempuan</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No. Hp</div>
                                <div class="col-lg-9 col-md-8">{{$member->no_hp}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tgl. Registrasi</div>
                                <div class="col-lg-9 col-md-8">
                                    {{Carbon\Carbon::parse($reg->tgl_registrasi)->isoFormat('dddd, D MMMM Y')}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">No. Registrasi</div>
                                <div class="col-lg-9 col-md-8">{{$reg->no_registrasi}}</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="POST" action="/member/edit-pp/{{auth()->user()->id}}" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="row mb-3">
                                    <label for="pp" class="col-lg-3 col-form-label">Profile
                                        Image</label>
                                    <div class="col-lg-9">
                                        <img src="{{asset('assets/'.auth()->user()->pp_path)}}" alt="Profile">

                                        <div class="col-lg-12 pt-2">
                                            <div class="row">
                                                <div class="col-lg-10 pt-2">
                                                    <input name="pp" type="file" class="form-control @error('pp') is-invalid @enderror" id="pp">
                                                    @error('pp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-1 pt-2">
                                                    <button class="btn btn-primary btn-sm" type="submit"><i
                                                            class="bi bi-upload"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>

                            <form method="POST" action="/member/edit-profile/{{$member->id}}">
                                @method('patch')
                                @csrf
                                <div class="row mb-3">
                                    <label for="nama_depan" class="col-md-4 col-lg-3 col-form-label">Nama Depan</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nama_depan" type="text" class="form-control" id="nama_depan"
                                            value="{{$member->nama_depan}}" @error('nama_depan') is-invalid @enderror> 
                                        @error('nama_depan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_belakang" class="col-md-4 col-lg-3 col-form-label">Nama
                                        Belakang</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nama_belakang" type="text" class="form-control" id="nama_belakang"
                                            value="{{$member->nama_belakang}}" @error('nama_belakang') is-invalid @enderror>
                                        @error('nama_belakang')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_hp" class="col-md-4 col-lg-3 col-form-label">No. Hp</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="no_hp" type="text" class="form-control" id="no_hp"
                                            value="{{$member->no_hp}}" onkeypress="return hanyaAngka(event)" @error('no_hp') is-invalid @enderror>
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="POST" action="/member/edit-password/{{auth()->user()->id}}">
                                @method('patch')
                                @csrf
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                            value="{{old('password')}}">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                            value="{{old('password_confirmation')}}">
                                        @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
