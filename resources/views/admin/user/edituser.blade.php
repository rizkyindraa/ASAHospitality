@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Admin Management')

@section('container')

<div class="pagetitle">
    <div class="row g-2">
        <div class="col-md-6">
            <h1>Edit Admin</h1>
        </div>
        <div class="col-md-6">
            <a href="{{route('admin')}}" class="btn btn-secondary mb-2" style="float:right;">Kembali <i
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
                            data-bs-target="#profile-content">Akun</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#display">Password</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-content pt-3" id="profile-content">

                        <form method="POST" action="{{url('update_admin_akun', $user->id)}}">
                            @method('patch')
                            @csrf
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-lg-2 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-10">
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror" id="username"
                                        value="{{ $user->username }}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-2 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-10">
                                    <input name="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        value="{{ $user->email }}">
                                    @error('email')
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
                        <form method="POST" action="{{url('update_admin_password', $user->id)}}">
                            @method('patch')
                            @csrf
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-lg-2 col-form-label">Password</label>
                                <div class="col-md-8 col-lg-10">
                                    <input name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        value="{{old('password')}}">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
