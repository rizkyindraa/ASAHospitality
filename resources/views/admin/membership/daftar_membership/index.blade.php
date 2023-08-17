@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Membership')

@section('container')

<script type="text/javascript">

</script>

<div class="pagetitle">
    <h1>Daftar Registrasi Membership</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="{{route('dm_search')}}">
                              <input type="text" name="cari" id="cari" placeholder="Search" title="Enter search keyword">
                              <a type="submit" href="{{route('daftar_membership')}}" class="btn-refresh" title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                              <button type="submit" class="btn-search" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                    </div>
                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Registrasi Membership</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">#</th>
                                <th scope="col" style="text-align:center;">Info Registrasi</th>
                                <th scope="col" style="text-align:center;">Nama</th>
                                <th scope="col" style="text-align:center;">Email</th>
                                <th scope="col" style="text-align:center;">No. Hp</th>
                                <th scope="col" style="text-align:center;">Membership</th>
                                <th scope="col" style="text-align:center;width:180px;">Verifikasi Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$registrations->isEmpty())
                            @foreach($registrations as $reg)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{Carbon\Carbon::parse($reg->tgl_registrasi)->isoFormat('dddd, D MMMM Y')}}
                                    <br>
                                    {{$reg->no_registrasi}}
                                </td>
                                <td>{{$reg->nama_depan}} {{$reg->nama_belakang}}</td>
                                <td>{{$reg->email}}</td>
                                <td>{{$reg->no_hp}}</td>
                                <td>{{$reg->nama_membership}}</td>
                                <td style="text-align:center;">
                                    @if($reg->is_verified == 0 and is_null($reg->email_verified_at))
                                    <p style="color: #cc271f;margin:0;">Belum Verifikasi</p>
                                    <p>-<p>
                                    @else
                                    <p style="color: #2bc740;margin:0;">Sudah Verifikasi</p>
                                    <p>{{Carbon\Carbon::parse($reg->email_verified_at)->isoFormat('dddd, D MMMM Y')}}
                                    </p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <td colspan="7" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$registrations->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
