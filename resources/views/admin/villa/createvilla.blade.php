@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Slider')

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
            <h1>Tambah Villa</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('villa')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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
                    <form class="row g-3" method="POST" action="{{route('store_villa')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="nama_villa" class="form-label">Nama Villa</label>
                            <input type="text" class="form-control @error('nama_villa') is-invalid @enderror"
                                id="nama_villa" name="nama_villa" placeholder="Silahkan input nama villa"
                                value="{{old('nama_villa')}}">
                            @error('nama_villa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                id="subtitle" name="subtitle" placeholder="Silahkan input subtitle"
                                value="{{old('subtitle')}}">
                            @error('subtitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="size" class="form-label">Size</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('size') is-invalid @enderror" id="size"
                                    name="size" placeholder="Silahkan input size" value="{{old('size')}}"
                                    aria-describedby="basic-addon2" aria-label="Silahkan input size" onkeypress="return hanyaAngka(event)">
                                <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                                @error('size')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="occupancy" class="form-label">Occupancy</label>
                            <input type="text" class="form-control @error('occupancy') is-invalid @enderror"
                                id="occupancy" name="occupancy" placeholder="Silahkan input occupancy"
                                value="{{old('occupancy')}}">
                            @error('occupancy')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="bed_type" class="form-label">Bed Type</label>
                            <select id="bed_type" name="bed_type"
                                class="form-select @error('bed_type') is-invalid @enderror" required>
                                <option disabled value selected>Pilih Tipe Bed</option>
                                <option value="Single Bed">Single Bed</option>
                                <option value="Twin bed">Twin bed</option>
                                <option value="Double Bed">Double Bed</option>
                                <option value="King Size">King Size</option>
                                <option value="Super King Size">Super King Size</option>
                            </select>
                            @error('bed_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                                name="deskripsi" placeholder="Silahkan input deskripsi">{{old('deskripsi')}}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="yt_link" class="form-label">Link Youtube</label>
                            <input type="text" class="form-control @error('yt_link') is-invalid @enderror" id="yt_link"
                                name="yt_link" placeholder="Silahkan input link youtube" value="{{old('yt_link')}}">
                            <p style="font-size: 10px">jika link = https://www.youtube.com/watch?v=N_ZLT1pwqns ganti "watch?v=" menjadi "embed/" sehingga menjadi https://www.youtube.com/embed/N_ZLT1pwqns</p>
                            @error('yt_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="display" class="form-label">Display Picture</label>
                            <input class="form-control @error('display') is-invalid @enderror" type="file"
                                id="display" name="display">
                            <p style="font-size: 10px">rekomendasi resolusi 600x800 untuk tampilan yang lebih baik</p>
                            @error('display')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="floor_plan" class="form-label">Floor Plan</label>
                            <input class="form-control @error('floor_plan') is-invalid @enderror" type="file"
                                id="floor_plan" name="floor_plan">
                            @error('floor_plan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="ubication" class="form-label">Ubication</label>
                            <input type="text" class="form-control @error('ubication') is-invalid @enderror"
                                id="ubication" name="ubication" placeholder="Silahkan input ubication"
                                value="{{old('ubication')}}">
                            @error('ubication')
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
