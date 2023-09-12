@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | How to Get Here')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Tambah How to Get Here</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('here')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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
                    <form class="row g-3" method="POST" action="{{ route('store_here') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="way_name" class="form-label">How to Get Here</label>
                            <input type="text" class="form-control @error('way_name') is-invalid @enderror"
                                id="way_name" name="way_name" placeholder="Silahkan input Nama Facility"
                                value="{{old('way_name')}}">
                            @error('way_name')
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
                            <label for="description" class="form-label">Deskripsi</label>
                            <input type="hidden" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" placeholder="Silahkan input description"
                                value="{{old('description')}}">
                            <trix-editor input="description"></trix-editor>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="way_picture" class="form-label">Picture</label>
                            <input class="form-control @error('way_picture') is-invalid @enderror" type="file" id="way_picture"
                                name="way_picture">
                            @error('way_picture')
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