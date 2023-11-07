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
            <h1>Tambah Team</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('team')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
                    class="bi bi-backspace"></i></a>
        </div>
    </div>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('status')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Multi Columns Form -->
                    <form class="row g-3" method="POST" action="{{route('store_team')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" placeholder="Silahkan input nama villa" value="{{old('nama')}}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="posisi" class="form-label">Posisi</label>
                            <input type="text" class="form-control @error('posisi') is-invalid @enderror" id="posisi"
                                name="posisi" placeholder="Silahkan input posisi" value="{{old('posisi')}}">
                            @error('posisi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Silahkan input email" value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">No. Hp</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    name="no_hp" placeholder="Silahkan input nomor hp" value="{{old('no_hp')}}"
                                    aria-describedby="basic-addon1" aria-label="Silahkan input nomor hp"
                                    onkeypress="return hanyaAngka(event)">
                                @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="ig_link" class="form-label">Link Instagram</label>
                            <input type="text" class="form-control @error('ig_link') is-invalid @enderror" id="ig_link"
                                name="ig_link" placeholder="Silahkan input link instagram" value="{{old('ig_link')}}">
                            <p style="font-size: 10px">optional</p>
                            @error('ig_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="fb_link" class="form-label">Link Facebook</label>
                            <input type="text" class="form-control @error('fb_link') is-invalid @enderror" id="fb_link"
                                name="fb_link" placeholder="Silahkan input link facebook" value="{{old('fb_link')}}">
                            <p style="font-size: 10px">optional</p>
                            @error('fb_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="tw_link" class="form-label">Link Twitter</label>
                            <input type="text" class="form-control @error('tw_link') is-invalid @enderror" id="tw_link"
                                name="tw_link" placeholder="Silahkan input link twitter" value="{{old('tw_link')}}">
                            <p style="font-size: 10px">optional</p>
                            @error('tw_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="li_link" class="form-label">Link LinkedIn</label>
                            <input type="text" class="form-control @error('li_link') is-invalid @enderror" id="li_link"
                                name="li_link" placeholder="Silahkan input link linked in" value="{{old('li_link')}}">
                            <p style="font-size: 10px">optional</p>
                            @error('li_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="foto" class="form-label">Foto <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 600x600"></i></label>
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto"
                                name="foto">
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" style="float:right">Tambah</button>
                        </div>
                    </form><!-- End Multi Columns Form -->

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
