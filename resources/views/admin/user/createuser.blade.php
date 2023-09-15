@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Admin Management')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Tambah Admin</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('admin')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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

                    <!-- Multi Columns Form -->
                    <form class="row g-3" method="POST" action="{{route('store_admin')}}">
                        @csrf
                        <div class="col-md-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                name="username" placeholder="Silahkan input username" value="{{old('username')}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password" placeholder="Silahkan input password" value="{{old('password')}}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Silahkan input email" value="{{old('email')}}">
                            @error('email')
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
