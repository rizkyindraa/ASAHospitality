@extends('layout.useradminlayout')

@section('title', 'ASA Hospitality | Voucher')

@section('container')

<div class="pagetitle">
    <h1>Voucher Menginap</h1>
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
                                action="{{route('voucher_search')}}">
                                <input type="text" name="cari" id="cari" placeholder="Search"
                                    title="Enter search keyword">
                                <a type="submit" href="{{route('member_voucher')}}" class="btn-refresh"
                                    title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                                <button type="submit" class="btn-search" title="Search"><i
                                        class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="" class="btn btn-primary mb-2" style="float:right;" data-bs-toggle="modal"
                            data-bs-target="#voucher_create">Tambah <i class="bi bi-plus-square"></i></a>
                        </div>
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
                                <th scope="col" style="text-align:center;width:200px;">Tgl. Voucher</th>
                                <th scope="col" style="text-align:center;">Penerima</th>
                                <th scope="col" style="text-align:center;">Keterangan</th>
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
                                <td>{{$v->penerima}}</td>
                                <td>{{$v->keterangan}}</td>
                                <td style="text-align:center;">
                                    <a href="/member/voucher/e-voucher/{{$v->id}}" class="badge bg-warning" style="width: 40px;"><i class="bi bi-printer"></i></a>
                                </td>
                            </tr>
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

    <div class="modal fade" id="voucher_create" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pemakaian Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($reg->status_penerimaan_membership == 1)
                    <form class="row g-3" method="POST" action="{{route('store_voucher')}}">
                        @csrf
                        <div class="col-md-4">
                            <label for="voucher" class="form-label">Jumlah Voucher</label>
                            <input type="text"
                                class="form-control"
                                id="voucher" name="voucher" value="{{$membership->jumlah_voucher}}"
                                disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="voucher-used" class="form-label">Voucher Terpakai</label>
                            <input type="text"
                                class="form-control"
                                id="voucher-used" name="voucher-used" value="{{$vouchers->count()}}"
                                disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="sisa-voucher" class="form-label">Sisa Voucher</label>
                            <input type="text"
                                class="form-control"
                                id="sisa-voucher" name="sisa-voucher"
                                disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="tgl_voucher" class="form-label">Tgl. Voucher</label>
                            <input type="date"
                                class="form-control @error('tgl_voucher') is-invalid @enderror"
                                id="tgl_voucher" name="tgl_voucher"
                                placeholder="Masukkan Nama Membership"
                                value="{{old('tgl_voucher')}}" required>
                            @error('tgl_voucher')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="penerima" class="form-label">Penerima</label>
                            <input type="text"
                                class="form-control @error('penerima') is-invalid @enderror"
                                id="penerima" name="penerima"
                                placeholder="Masukkan penerima"
                                value="{{old('penerima')}}" required>
                            @error('penerima')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea
                                class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" name="keterangan"
                                placeholder="Masukkan keterangan" value="{{old('keterangan')}}"
                                onkeypress="return hanyaAngka(event)" required></textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        @if($vouchers->count() == $membership->jumlah_voucher)
                        <div class="col-md-12 alert alert-danger alert-dismissible fade show">
                            Anda Sudah mencapai batas pemakaian voucher 
                        </div>
                        @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>
                    @if($vouchers->count() < $membership->jumlah_voucher)
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    @elseif($vouchers->count() == $membership->jumlah_voucher)
                    <button type="submit" class="btn btn-primary" disabled>Tambah</button>
                    @endif
                </div>
                </form><!-- End Multi Columns Form -->
                @elseif($reg->status_penerimaan_membership == 2)
                    <div class="col-md-12 alert alert-danger alert-dismissible fade show">
                        Maaf anda batal menjadi membership, anda tidak bisa memakai voucher
                    </div>
                @elseif($reg->status_penerimaan_membership == 0)
                    <div class="col-md-12 alert alert-danger alert-dismissible fade show">
                        Maaf status membership anda masih "Member Pasif", anda belum bisa memakai voucher
                    </div>
                @endif
            </div>
        </div>
    </div> <!-- End Modal Validation -->

</section>

<script>
    var voucher = parseFloat(document.getElementById("voucher").value);
    var voucher_used = parseFloat(document.getElementById("voucher-used").value);
    var sisa_voucher = voucher - voucher_used;
    document.getElementById("sisa-voucher").value = sisa_voucher;
</script>

@endsection