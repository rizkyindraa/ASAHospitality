@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Welcome')

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
    <h1>Section Contact</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session('status')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    <form method="POST" action="{{url('update_contact', $contact->id)}}">
                        @method('patch')
                        @csrf
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-lg-2 col-form-label">Phone</label>
                            <div class="col-md-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input name="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        value="{{ $contact->phone }}" aria-describedby="basic-addon1"
                                        aria-label="Silahkan input phone" onkeypress="return hanyaAngka(event)">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-2 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-10">
                                <input name="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    value="{{ $contact->email }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="office_address" class="col-md-4 col-lg-2 col-form-label">Office Address</label>
                            <div class="col-md-8 col-lg-10">
                                <input name="office_address" type="text"
                                    class="form-control @error('office_address') is-invalid @enderror" id="office_address"
                                    value="{{ $contact->office_address }}">
                                @error('office_address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="villa_address" class="col-md-4 col-lg-2 col-form-label">Villa Address</label>
                            <div class="col-md-8 col-lg-10">
                                <input name="villa_address" type="text"
                                    class="form-control @error('villa_address') is-invalid @enderror" id="villa_address"
                                    value="{{ $contact->villa_address }}">
                                @error('villa_address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="map" class="col-md-4 col-lg-2 col-form-label">Map</label>
                            <div class="col-md-8 col-lg-10">
                                <input name="map" type="text"
                                    class="form-control @error('map') is-invalid @enderror" id="map"
                                    value="{{ $contact->map }}">
                                @error('map')
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

            </div>
        </div>
    </div>
</section>

@endsection