@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Membership')

@section('container')

<div class="pagetitle">
    <h1>Daftar Member</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET"
                                action="{{route('dms_search')}}">
                                <input type="text" name="cari" id="cari" placeholder="Search"
                                    title="Enter search keyword">
                                <a type="submit" href="{{route('daftar_member')}}" class="btn-refresh"
                                    title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                                <button type="submit" class="btn-search" title="Search"><i
                                        class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                    </div>
                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Member</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">#</th>
                                <th scope="col" style="text-align:center;">Nama</th>
                                <th scope="col" style="text-align:center;width:100px;">Periode Membership</th>
                                <th scope="col" style="text-align:center;width:120px;">Status Membership</th>
                                <th scope="col" style="text-align:center;width:200px;">Tgl. Aktif Membership</th>
                                <th scope="col" style="text-align:center;width:200px;">Tgl. Berakhir Membership</th>
                                <th scope="col" style="text-align:center;width:100px;">Sisa Waktu Membership</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$members->isEmpty())
                            @foreach($members as $member)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$member->nama_depan}} {{$member->nama_belakang}}
                                    <br>
                                    {{$member->no_registrasi}}
                                    <br>
                                    {{$member->nama_membership}}
                                </td>
                                <td>{{$member->periode}} {{$member->satuan_periode}}</td>
                                <td style="text-align:center;"> <p style="color: #2bc740;margin:0;">Member Aktif</p></td>
                                <td>{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->isoFormat('dddd, D MMMM Y')}}</td>
                                <td>
                                    @if($member->satuan_periode == "Tahun")
                                    {{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addYears($member->periode)->isoFormat('dddd, D MMMM Y')}}
                                    @elseif($member->satuan_periode == "Minggu")
                                    {{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addWeeks($member->periode)->isoFormat('dddd, D MMMM Y')}}
                                    @else
                                    {{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addDays($member->periode)->isoFormat('dddd, D MMMM Y')}}
                                    @endif
                                </td>
                                <td>
                                    @if($member->satuan_periode == "Tahun")
                                    <span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addYears($member->periode)->diffInDays(now())}}</span> Hari</td>
                                    @elseif($member->satuan_periode == "Minggu")
                                    <span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addWeeks($member->periode)->diffInDays(now())}}</span> Hari</td>
                                    @else
                                    <span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addDays($member->periode)->diffInDays(now())}}</span> Hari</td>
                                    @endif
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
                    {{$members->links()}}
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    var val = document.getElementById("sisa").innerHTML;
    var num_val = Number(val);
    document.getElementById("sisa").innerHTML = num_val.toLocaleString('id-ID')
</script>

@endsection
