@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | How to Get Here')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Edit How to Get Here</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('here')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#picture">Picture</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-content pt-3" id="profile-content">

                        <form method="POST" action="{{url('update_get_here_konten', $way->id)}}">
                            @method('patch')
                            @csrf
                            <div class="row mb-3">
                                <label for="way_name" class="col-md-4 col-lg-2 col-form-label">How to Get Here</label>
                                <div class="col-md-8 col-lg-10">
                                    <input name="way_name" type="text"
                                        class="form-control @error('way_name') is-invalid @enderror" id="way_name"
                                        value="{{ $way->way_name }}">
                                    @error('way_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subtitle" class="col-md-4 col-lg-2 col-form-label">Subtitle</label>
                                <div class="col-md-8 col-lg-10">
                                    <textarea name="subtitle" class="form-control @error('subtitle') is-invalid @enderror"
                                        id="subtitle">{{ $way->subtitle }}</textarea>
                                    @error('subtitle')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-lg-2 col-form-label">Deskripsi</label>
                                <div class="col-md-8 col-lg-10">
                                    <input name="description" class="form-control @error('description') is-invalid @enderror"
                                        id="description" value="{{ $way->description }}" type="hidden">
                                    <trix-editor input="description"></trix-editor>    
                                    @error('description')
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

                    <div class="tab-pane fade pt-3" id="picture">
                        <!-- Change Password Form -->
                        <!-- Profile Edit Form -->
                        <form method="POST" action="{{url('update_get_here_picture', $way->id)}}"
                            enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <img src="{{asset('assets/'. $way->way_picture)}}" alt="picture"
                                style="width:20%; display: block; margin:auto; padding-bottom:10px;">
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-2 col-form-label">Picture <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 800x600"></i></label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="pt-2">
                                        <input class="form-control @error('way_picture') is-invalid @enderror"
                                            type="file" id="way_picture" name="way_picture">
                                        @error('way_picture')
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
