@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Facility')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Tambah Facility</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('facility')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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
                    <form class="row g-3" method="POST" action="{{ route('store_facility') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="facilities_name" class="form-label">Nama Facility</label>
                            <input type="text" class="form-control @error('facilities_name') is-invalid @enderror"
                                id="facilities_name" name="facilities_name" placeholder="Silahkan input Nama Facility"
                                value="{{old('facilities_name')}}">
                            @error('facilities_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="subtitle" class="form-label">Subtitle</label>
                                <textarea class="form-control @error('subtitle') is-invalid @enderror"
                                id="subtitle" name="subtitle" placeholder="Silahkan input subtitle"
                                >{{old('subtitle')}}</textarea>
                            @error('subtitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="facilities_picture" class="form-label">Facility Picture <i class="bi bi-exclamation-circle-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="Recomended Resolution 800x600"></i></label>
                            <input class="form-control @error('facilities_picture') is-invalid @enderror" type="file" id="facilities_picture"
                                name="facilities_picture">
                            @error('facilities_picture')
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