@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Membership')

@section('container')

<div class="pagetitle">
    <h1>Penggunaan Voucher Menginap</h1>
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
                                action="">
                                <input type="text" name="cari" id="cari" placeholder="Search"
                                    title="Enter search keyword">
                                <a type="submit" href="{{route('list_voucher')}}" class="btn-refresh"
                                    title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                                <button type="submit" class="btn-search" title="Search"><i
                                        class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                    </div>

                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{session('status')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Voucher yang Sudah Terpakai</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;width:200px;">Info Voucher</th>
                                <th scope="col" style="text-align:center;width:300px;">Pemberi</th>
                                <th scope="col" style="text-align:center;">Penerima</th>
                                <th scope="col" style="text-align:center;width:200px;">Status</th>
                                <th scope="col" style="text-align:center;width:40px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$vouchers->isEmpty())
                            @foreach($vouchers as $v)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$v->no_voucher}}
                                    <br>
                                    {{Carbon\Carbon::parse($v->tgl_voucher)->isoFormat('dddd, D MMMM Y')}}
                                </td>
                                <td>{{$v->nama_depan}} {{$v->nama_belakang}}
                                    <br>
                                    {{$v->email}}
                                </td>
                                <td>{{$v->penerima}}</td>
                                <td style="text-align: center">
                                    @if($v->status == 1)
                                    <span style="color: #2bc740">Masih Aktif</span>
                                    <br>
                                    {{Carbon\Carbon::parse($v->tgl_berubah_status)->isoFormat('dddd, D MMMM Y')}}
                                    @else
                                    <span style="color: #cc271f">Sudah Dipakai</span>
                                    <br>
                                    {{Carbon\Carbon::parse($v->tgl_berubah_status)->isoFormat('dddd, D MMMM Y')}}
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-warning" data-bs-toggle="modal"
                                    data-bs-target="#status{{$v->id}}" style="width: 40px;"><i class="bi bi-arrow-clockwise"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="status{{$v->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan mengganti status data ini?</p>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Tgl. Voucher</label>
                                                    <p>{{Carbon\Carbon::parse($v->tgl_voucher)->isoFormat('dddd, D MMMM Y')}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">No. Voucher</label>
                                                    <p>{{$v->no_voucher}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Pemberi Voucher</label>
                                                    <p>{{$v->nama_depan}} {{$v->nama_belakang}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Penerima Voucher</label>
                                                    <p>{{$v->penerima}}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Keterangan</label>
                                                <p>{{$v->keterangan}}</p>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label for="inputName5" class="form-label fw-bold">Status Voucher Saat Ini</label>
                                                @if($v->status == 1)
                                                <p style="color: #2bc740">Masih Aktif</p>
                                                @else
                                                <p style="color: #cc271f">Sudah Dipakai</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Kembali</button>
                                            <a href="/voucher_status_update/{{$v->id}}"
                                                    class="btn btn-warning">Update</i></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- End Modal Validation -->

                            @endforeach
                            @else
                            <td colspan="8" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$vouchers->links()}}
                </div>

            </div>
        </div>
    </div>

</section>

@endsection