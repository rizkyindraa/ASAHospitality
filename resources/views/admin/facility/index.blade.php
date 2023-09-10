@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Facility')

@section('container')

<div class="pagetitle">
    <h1>Daftar Konten Facility</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="{{route('facility_search')}}">
                              <input type="text" name="cari" placeholder="Cari" title="Enter search keyword">
                              <a type="submit" href="{{route('facility')}}" class="btn-refresh" title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                              <button type="submit" class="btn-search" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="{{route('create_facility')}}" class="btn btn-primary mb-2" style="float:right;">Tambah <i class="bi bi-plus-square"></i></a>
                        </div>
                    </div>
                    
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session('status')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session('delete'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{session('delete')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Facility</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Nama Facility</th>
                                <th scope="col" style="text-align:center;width:500px;">Subtitle</th>
                                <th scope="col" style="text-align:center;width:109px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$facilities->isEmpty())
                            @foreach($facilities as $facility)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$facility->facilities_name}}</td>
                                <td>{{$facility->subtitle}}</td>
                                <td style="text-align:center;">
                                    <a href="{{url('edit_facility', $facility->id)}}" class="badge bg-warning" style="width: 40px;"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{url('delete_facility', $facility->id)}}" class="badge bg-danger" style="width: 40px;"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td colspan="4" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$facilities->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection