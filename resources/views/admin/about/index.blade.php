@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | About Us')

@section('container')

<div class="pagetitle">
    <h1>Section About Us</h1>
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
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#picture">Welcome Image</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-content pt-3" id="profile-content">

                        <form method="POST" action="{{url('update_about_konten', $about->id)}}">
                            @method('patch')
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-lg-2 col-form-label">Title</label>
                                <div class="col-md-8 col-lg-10">
                                    <input name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $about->title }}">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="post" class="col-md-4 col-lg-2 col-form-label">Post</label>
                                <div class="col-md-8 col-lg-10">
                                    <textarea name="post"
                                        class="form-control @error('post') is-invalid @enderror" id="post"
                                        >{{ $about->post }}</textarea>
                                    @error('post')
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
                        <form method="POST" action="{{url('update_about_foto', $about->id)}}" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <img src="{{asset('assets/'. $about->about_picture)}}" alt="picture" style="width:20%; display: block; margin:auto; padding-bottom:10px;">
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-2 col-form-label">About Image</label>
                                <div class="col-md-8 col-lg-10">
                                    <div class="pt-2">
                                        <input class="form-control @error('about_picture') is-invalid @enderror" type="file"
                                            id="about_picture" name="about_picture">
                                        @error('about_picture')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="float:right;">Edit</button>
                            </div>
                        </form>
                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>

    </div>
</section>

@endsection