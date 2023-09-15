@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Team')

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
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Edit Team</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('team')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
                    class="bi bi-backspace"></i></a>
        </div>
    </div>
</div><!-- End Page Title -->

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<section class="section profile">
    <div class="col-xl-12">

        <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#profile-content">Konten</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#display">Foto</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-content pt-3" id="profile-content">

                        <form method="POST" action="{{url('update_team_konten', $team->id)}}">
                            @method('patch')
                            @csrf
                            <div class="row mb-3">
                                <label for="nama" class="col-md-4 col-lg-2 col-form-label">Nama</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" id="nama"
                                        value="{{ $team->nama }}">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="posisi" class="col-md-4 col-lg-2 col-form-label">Posisi</label>
                                <div class="col-md-8 col-lg-10">
                                    <input name="posisi" type="text"
                                        class="form-control @error('posisi') is-invalid @enderror" id="posisi"
                                        value="{{ $team->posisi }}">
                                    @error('posisi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-2 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        value="{{ $team->email }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_hp" class="col-md-4 col-lg-2 col-form-label">No. Hp</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                        <input name="no_hp" type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                            value="{{ $team->no_hp }}" aria-describedby="basic-addon1"
                                            aria-label="Silahkan input nomor hp" onkeypress="return hanyaAngka(event)">
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ig_link" class="col-md-4 col-lg-2 col-form-label">Link Instagram</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="ig_link"
                                        class="form-control @error('ig_link') is-invalid @enderror" id="ig_link"
                                        value="{{ $team->ig_link }}">
                                    @error('ig_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="fb_link" class="col-md-4 col-lg-2 col-form-label">Link Facebook</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="fb_link"
                                        class="form-control @error('fb_link') is-invalid @enderror" id="fb_link"
                                        value="{{ $team->fb_link }}">
                                    @error('fb_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tw_link" class="col-md-4 col-lg-2 col-form-label">Link Twitter</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="tw_link"
                                        class="form-control @error('tw_link') is-invalid @enderror" id="tw_link"
                                        value="{{ $team->tw_link }}">
                                    @error('tw_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="li_link" class="col-md-4 col-lg-2 col-form-label">Link LinkedIn</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="li_link"
                                        class="form-control @error('li_link') is-invalid @enderror" id="li_link"
                                        value="{{ $team->li_link }}">
                                    @error('li_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="float:right;">Edit</button>
                            </div>
                        </form><!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="display">
                        <!-- Change Password Form -->
                        <!-- Profile Edit Form -->
                        <form method="POST" action="{{url('update_team_foto', $team->id)}}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <img src="{{asset('assets/'. $team->foto)}}" alt="picture"
                                style="width:20%; display: block; margin:auto; padding-bottom:10px;">
                            <div class="row mb-3">
                                <label for="foto" class="col-md-4 col-lg-2 col-form-label">Foto</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="pt-2">
                                        <input class="form-control @error('foto') is-invalid @enderror"
                                            type="file" id="foto" name="foto">
                                        @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <button type="submit" class="btn btn-primary"
                                            style="margin-top: 10px; float:right;"><i class="bi bi-upload">
                                            </i></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>

    </div>
</section>

@endsection
