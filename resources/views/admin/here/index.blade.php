@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | How to Get Here')

@section('container')

<div class="pagetitle">
    <h1>Daftar Konten How to Get Here</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="{{route('here_search')}}">
                              <input type="text" name="cari" placeholder="Cari" title="Enter search keyword">
                              <a type="submit" href="{{route('here')}}" class="btn-refresh" title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                              <button type="submit" class="btn-search" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="{{route('create_here')}}" class="btn btn-primary mb-2" style="float:right;">Tambah <i class="bi bi-plus-square"></i></a>
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
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data How to Get Here</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">How to Get Here</th>
                                <th scope="col" style="text-align:center;width:200px;">Subtitle</th>
                                <th scope="col" style="text-align:center;width:500px;">Deskripsi</th>
                                <th scope="col" style="text-align:center;width:109px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$ways->isEmpty())
                            @foreach($ways as $way)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$way->way_name}}</td>
                                <td>{{$way->subtitle}}</td>
                                <td>{!!$way->description!!}</td>
                                <td style="text-align:center;">
                                    <a href="{{url('edit_get_here', $way->id)}}" class="badge bg-warning" style="width: 40px;"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="{{url('delete_get_here', $way->id)}}" class="badge bg-danger" style="width: 40px;"><i class="bi bi-trash"></i></a>
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
                    {{$ways->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection