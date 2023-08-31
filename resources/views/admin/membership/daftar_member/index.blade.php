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
                                <th scope="col" style="text-align:center;width:50px;">Aksi</th>
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
                                    <span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addYears($member->periode)->diffInDays(now())}}</span> Hari
                                    @elseif($member->satuan_periode == "Minggu")
                                    <span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addWeeks($member->periode)->diffInDays(now())}}</span> Hari
                                    @else
                                    <span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addDays($member->periode)->diffInDays(now())}}</span> Hari
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-primary" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#detail{{$member->id}}"><i
                                            class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="detail{{$member->id}}" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Member</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Nama</label>
                                                        <p>{{$member->nama_depan}} {{$member->nama_belakang}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Jenis Kelamin</label>
                                                        @if($member->jenis_kelamin == 'laki')
                                                        <p>Laki-Laki</p>
                                                        @else
                                                        <p>Perempuan</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">No. Hp</label>
                                                        <p>{{$member->no_hp}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Email</label>
                                                        <p>{{$member->email}}</p>
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Username</label>
                                                        <p>{{$member->username}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Tgl. Aktif Membership</label>
                                                        <p>{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->isoFormat('dddd, D MMMM Y')}}</p>
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Tgl. Berakhir Membership</label>
                                                        @if($member->satuan_periode == "Tahun")
                                                        <p>{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addYears($member->periode)->isoFormat('dddd, D MMMM Y')}}</p>
                                                        @elseif($member->satuan_periode == "Minggu")
                                                        <p>{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addWeeks($member->periode)->isoFormat('dddd, D MMMM Y')}}</p>
                                                        @else
                                                        <p>{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addDays($member->periode)->isoFormat('dddd, D MMMM Y')}}</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Sisa Waktu Membership</label>
                                                        @if($member->satuan_periode == "Tahun")
                                                        <p><span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addYears($member->periode)->diffInDays(now())}}</span> Hari</p>
                                                        @elseif($member->satuan_periode == "Minggu")
                                                        <p><span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addWeeks($member->periode)->diffInDays(now())}}</span> Hari</p>
                                                        @else
                                                        <p><span id="sisa">{{Carbon\Carbon::parse($member->tgl_penerimaan_membership)->addDays($member->periode)->diffInDays(now())}}</span> Hari</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Voucher Menginap</label>
                                                        <p><span id='voucher'>{{$member->jumlah_voucher}}</span> Voucher</p>
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Voucher Terpakai</label>
                                                        <p><span id='voucher-used'>{{$member->voucher_used}}</span> Voucher</p>
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Sisa Voucher</label>
                                                        <p><span id="sisa-voucher"></span> Voucher</p>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Detail Modal -->
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

    var voucher = parseFloat(document.getElementById("voucher").innerHTML);
    var voucher_used = parseFloat(document.getElementById("voucher-used").innerHTML);
    var sisa_voucher = voucher - voucher_used;
    document.getElementById("sisa-voucher").innerHTML = sisa_voucher;
</script>

@endsection
