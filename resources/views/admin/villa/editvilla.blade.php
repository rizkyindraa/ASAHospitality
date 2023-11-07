@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Villa')

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
            <h1>Edit Villa</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('villa')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#display">Display</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#picture">Floor Plan</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-content pt-3" id="profile-content">

                        <form method="POST" action="{{url('update_villa_konten', $villa->id)}}">
                            @method('patch')
                            @csrf
                            <div class="row mb-3">
                                <label for="nama_villa" class="col-md-4 col-lg-2 col-form-label">Nama Villa</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="nama_villa"
                                        class="form-control @error('nama_villa') is-invalid @enderror" id="nama_villa"
                                        value="{{ $villa->nama_villa }}">
                                    @error('nama_villa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subtitle" class="col-md-4 col-lg-2 col-form-label">Subtitle</label>
                                <div class="col-md-8 col-lg-10">
                                    <input name="subtitle" type="text"
                                        class="form-control @error('subtitle') is-invalid @enderror" id="subtitle"
                                        value="{{ $villa->subtitle }}">
                                    @error('subtitle')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="size" class="col-md-4 col-lg-2 col-form-label">Size</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="input-group">
                                        <input name="size" type="text"
                                            class="form-control @error('size') is-invalid @enderror" id="size"
                                            value="{{ $villa->size }}" aria-describedby="basic-addon2"
                                            aria-label="Silahkan input size" onkeypress="return hanyaAngka(event)">
                                        <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                                        @error('size')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="occupancy" class="col-md-4 col-lg-2 col-form-label">Occupancy</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="occupancy"
                                        class="form-control @error('occupancy') is-invalid @enderror" id="occupancy"
                                        value="{{ $villa->occupancy }}">
                                    @error('occupancy')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="bed_type" class="col-md-4 col-lg-2 col-form-label">Bed Size</label>
                                <div class="col-md-8 col-lg-10">
                                    <select id="bed_type" name="bed_type"
                                        class="form-select @error('bed_type') is-invalid @enderror" required>
                                        <option disabled value>Pilih Kategori</option>
                                        <option value="Single Bed" @if($villa->bed_type =="Single Bed") selected
                                            @endif>Single Bed</option>
                                        <option value="Twin Bed" @if($villa->bed_type =="Twin Bed") selected @endif>Twin
                                            Bed</option>
                                        <option value="Double Bed" @if($villa->bed_type =="Double Bed") selected
                                            @endif>Double Bed</option>
                                        <option value="King Size" @if($villa->bed_type =="King Size") selected
                                            @endif>King Size</option>
                                        <option value="Super King Size" @if($villa->bed_type =="Super King Size")
                                            selected @endif>Super King Size</option>
                                    </select>
                                    @error('bed_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="deskripsi" class="col-md-4 col-lg-2 col-form-label">Deskripsi</label>
                                <div class="col-md-8 col-lg-10">
                                    <textarea name="deskripsi"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        id="deskripsi">{{ $villa->deskripsi }}</textarea>
                                    @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="yt_link" class="col-md-4 col-lg-2 col-form-label">Link Youtube</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="yt_link"
                                        class="form-control @error('yt_link') is-invalid @enderror" id="yt_link"
                                        value="{{ $villa->yt_link }}">
                                    @error('yt_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="ubication" class="col-md-4 col-lg-2 col-form-label">Ubication</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="ubication"
                                        class="form-control @error('ubication') is-invalid @enderror" id="ubication"
                                        value="{{ $villa->ubication }}">
                                    @error('ubication')
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
                        <form method="POST" action="{{url('update_villa_display', $villa->id)}}"
                            enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <img src="{{asset('assets/'. $villa->display)}}" alt="picture"
                                style="width:20%; display: block; margin:auto; padding-bottom:10px;">
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-2 col-form-label">Display Picture <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 1920x1080"></i></label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="pt-2">
                                        <input class="form-control @error('display') is-invalid @enderror"
                                            type="file" id="display" name="display">
                                        @error('display')
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

                    <div class="tab-pane fade pt-3" id="picture">
                        <!-- Change Password Form -->
                        <!-- Profile Edit Form -->
                        <form method="POST" action="{{url('update_villa_picture', $villa->id)}}"
                            enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <img src="{{asset('assets/'. $villa->floor_plan)}}" alt="picture"
                                style="width:20%; display: block; margin:auto; padding-bottom:10px;">
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-2 col-form-label">Floor Plan <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 1920x1080"></i></label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="pt-2">
                                        <input class="form-control @error('floor_plan') is-invalid @enderror"
                                            type="file" id="floor_plan" name="floor_plan">
                                        @error('floor_plan')
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
