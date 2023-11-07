@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Slider')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Tambah Slider</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('slider')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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
                    <form class="row g-3" method="POST" action="{{ route('store_slider') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title</label>
                            <textarea class="form-control @error('title') is-invalid @enderror"
                                id="title" name="title" placeholder="Silahkan input title"
                                value="{{old('title')}}"></textarea>
                            @error('title')
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

                        <div class="col-md-12">
                            <label for="slider_picture" class="form-label">Background Image <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 1920x1080"></i></label>
                            <input class="form-control @error('slider_picture') is-invalid @enderror" type="file" id="slider_picture"
                                name="slider_picture">
                            @error('slider_picture')
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