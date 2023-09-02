@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Membership')

@section('container')

<script>
    function Status() {
        var val = document.getElementById("penerimaan");
        var payment = document.getElementById("payment");
        if(val.value == "1") {
            payment.selectedIndex = 0;
            payment.disabled = false;
            payment.options[1].disabled = true;
        } else {
            payment.value = "No"
            payment.disabled = true;
        }
    }
</script>

<div class="pagetitle">
    <h1>Penerimaan Membership</h1>
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
                                action="{{route('pm_search')}}">
                                <input type="text" name="cari" id="cari" placeholder="Cari"
                                    title="Enter search keyword">
                                <a type="submit" href="{{route('penerimaan_membership')}}" class="btn-refresh"
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
                                <th scope="col" style="text-align:center;width:40px;">Aksi</th>
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
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-primary" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#add{{$reg->reg_id}}"><i class="bi bi-plus-lg"></i></a>
                                </td>
                            </tr>
                            <div class="modal fade" id="add{{$reg->reg_id}}" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Penerimaan Membership</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/update_penerimaan_membership/{{ $reg->reg_id }}">
                                                @method('patch')
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Tgl.
                                                            Registrasi</label>
                                                        <p>{{Carbon\Carbon::parse($reg->tgl_registrasi)->isoFormat('dddd, D MMMM Y')}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">No.
                                                            Registrasi</label>
                                                        <p>{{$reg->no_registrasi}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Email</label>
                                                        <p>{{$reg->nama_depan}} {{$reg->nama_belakang}}</p>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Jenis Kelamin</label>
                                                        @if($reg->jenis_kelamin == 'laki')
                                                        <p>Laki-Laki</p>
                                                        @else
                                                        <p>Perempuan</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Nama
                                                        Membership</label>
                                                    <p>{{$reg->nama_membership}}</p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Email</label>
                                                        <p>{{$reg->email}}</p>
                                                    </div>
                                                    <div class="col-md-3 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Status
                                                            Verifikasi</label>
                                                        <br>
                                                        @if($reg->is_verified == 1)
                                                        <p style="color: #2bc740;margin:0;">Sudah Verifikasi</p>
                                                        @else
                                                        <p style="color: #cc271f;margin:0;">Belum Verifikasi</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3 mt-2">
                                                        <label for="inputName5" class="form-label fw-bold">Tgl.
                                                            Verifikasi</label>
                                                        @if(is_null($reg->email_verified_at))
                                                        <p>-</p>
                                                        @else
                                                        <p>{{Carbon\Carbon::parse($reg->email_verified_at)->isoFormat('dddd, D MMMM Y')}}
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mt-2">
                                                        <label for="tgl_penerimaan" class="form-label">Tgl. Penerimaan Membership</label>
                                                        <br>
                                                        <input type="date" id="tgl_penerimaan" name="tgl_penerimaan" class="form-control @error('tgl_penerimaan') is-invalid @enderror"
                                                        value="{{old('tgl_penerimaan')}}">
                                                        @error('tgl_penerimaan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="penerimaan" class="form-label">Penerimaan Membership</label>
                                                        <select id="penerimaan" name="penerimaan"
                                                            class="form-select @error('penerimaan') is-invalid @enderror"
                                                            required onchange="Status()">
                                                            <option disabled value selected>Pilih Kategori</option>
                                                            <option value="1">Terima</option>
                                                            <option value="2">Batal</option>
                                                        </select>
                                                        @error('penerimaan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <label for="payment" class="form-label">Jenis Pembayaran</label>
                                                        <select id="payment" name="payment"
                                                            class="form-select @error('payment') is-invalid @enderror"
                                                            required>
                                                            <option disabled value selected>Pilih Pembayaran</option>
                                                            <option value="No">Tidak Ada Pembayaran</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Kredit">Kredit</option>
                                                        </select>
                                                        @error('payment')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        </form><!-- End Multi Columns Form -->
                                    </div>
                                </div>
                            </div> <!-- End Edit Modal -->

                            @endforeach
                            @else
                            <td colspan="8" style="text-align: center; font-weight: bold;">Tidak Ada Data</td>
                            @endif
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
                <div class="card-footer">
                    {{$registrations->links()}}
                </div>

                <div class="card-body">
                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">History Penerimaan Membership</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">#</th>
                                <th scope="col" style="text-align:center;width:180px;">Info Registrasi</th>
                                <th scope="col" style="text-align:center;">Nama</th>
                                <th scope="col" style="text-align:center;width:200px;">Membership</th>
                                <th scope="col" style="text-align:center;width:180px;">Verifikasi Email</th>
                                <th scope="col" style="text-align:center;width:200px;">Status Membership</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$historyregs->isEmpty())
                            @foreach($historyregs as $history)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{Carbon\Carbon::parse($history->tgl_registrasi)->isoFormat('dddd, D MMMM Y')}}
                                    <br>
                                    {{$history->no_registrasi}}
                                </td>
                                <td>{{$history->nama_depan}} {{$history->nama_belakang}}</td>
                                <td>{{$history->nama_membership}}</td>
                                <td style="text-align:center;">
                                    @if($history->is_verified == 0 and is_null($history->email_verified_at))
                                    <p style="color: #cc271f;margin:0;">Belum Verifikasi</p>
                                    <p>-<p>
                                    @else
                                    <p style="color: #2bc740;margin:0;">Sudah Verifikasi</p>
                                    <p>{{Carbon\Carbon::parse($history->email_verified_at)->isoFormat('dddd, D MMMM Y')}}
                                    </p>
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    @if($history->status_penerimaan_membership == 2)
                                    <p style="color: #cc271f;margin:0;">Batal Member</p>
                                    <p>-<p>
                                    @else
                                    <p style="color: #2bc740;margin:0;">Member Aktif</p>
                                    <p>{{Carbon\Carbon::parse($history->tgl_penerimaan_membership)->isoFormat('dddd, D MMMM Y')}}
                                    </p>
                                    @endif
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
                    {{$historyregs->links()}}
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
