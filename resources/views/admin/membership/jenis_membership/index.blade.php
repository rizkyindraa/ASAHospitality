@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Membership')

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
    <h1>Jenis Membership</h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 search-bar">
                            <form class="search-form d-flex align-items-center" method="GET" action="{{route('jm_search')}}">
                              <input type="text" name="cari" placeholder="Cari" title="Enter search keyword">
                              <a type="submit" href="{{route('jenis_membership')}}" class="btn-refresh" title="Search"><i class="bi bi-arrow-clockwise"></i></a>
                              <button type="submit" class="btn-search" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End Search Bar -->
                        <div class="col-lg-6">
                            <a href="" class="btn btn-primary mb-2" style="float:right;" data-bs-toggle="modal"
                            data-bs-target="#jm_create">Tambah <i class="bi bi-plus-square"></i></a>
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

                    <div class="modal fade" id="jm_create" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Jenis Membership</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" method="POST" action="{{ route('store_membership') }}">
                                        @csrf
                                        <div class="col-md-12">
                                            <label for="nama_membership" class="form-label">Nama Membership</label>
                                            <input type="text"
                                                class="form-control @error('nama_membership') is-invalid @enderror"
                                                id="nama_membership" name="nama_membership"
                                                placeholder="Masukkan Nama Membership"
                                                value="{{old('nama_membership')}}" required>
                                            @error('nama_membership')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="harga_membership" class="form-label">Harga Membership</label>
                                            <input type="text"
                                                class="form-control @error('harga_membership') is-invalid @enderror"
                                                id="harga_membership" name="harga_membership"
                                                placeholder="Masukkan Harga Membership"
                                                value="{{old('harga_membership')}}" autofocus required>
                                            @error('harga_membership')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <label for="jumlah_voucher" class="form-label">Jumlah Voucher</label>
                                            <input type="text"
                                                class="form-control @error('jumlah_voucher') is-invalid @enderror"
                                                id="jumlah_voucher" name="jumlah_voucher"
                                                placeholder="Masukkan Jumlah Voucher" value="{{old('jumlah_voucher')}}"
                                                onkeypress="return hanyaAngka(event)" required>
                                            @error('jumlah_voucher')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <label for="sharing_profit" class="form-label">Sharing Profit</label>
                                            <br>
                                            <input class="form-check-input" type="checkbox"
                                                class="form-control @error('sharing_profit') is-invalid @enderror"
                                                id="sharing_profit" name="sharing_profit" value="1">
                                            @error('sharing_profit')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-2">
                                            <label for="discount_product" class="form-label">Diskon Produk (%)</label>
                                            <input type="text"
                                                class="form-control @error('discount_product') is-invalid @enderror"
                                                id="discount_product" name="discount_product"
                                                placeholder="Masukkan Diskon Produk" value="{{old('discount_product')}}"
                                                onkeypress="return hanyaAngka(event)" required>
                                            @error('discount_product')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="periode" class="form-label">Periode Membership</label>
                                            <input type="text"
                                                class="form-control @error('periode') is-invalid @enderror" id="periode"
                                                name="periode" placeholder="Masukkan Periode Membership"
                                                value="{{old('periode')}}" required
                                                onkeypress="return hanyaAngka(event)">
                                            @error('periode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="satuan_periode" class="form-label">Satuan Periode
                                                Membership</label>
                                            <select id="satuan_periode" name="satuan_periode"
                                                class="form-select @error('satuan_periode') is-invalid @enderror"
                                                required>
                                                <option disabled value selected>Pilih Kategori</option>
                                                <option value="Hari">Hari</option>
                                                <option value="Bulan">Bulan</option>
                                                <option value="Tahun">Tahun</option>
                                            </select>
                                            @error('satuan_periode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                                </form><!-- End Multi Columns Form -->
                            </div>
                        </div>
                    </div> <!-- End Modal Validation -->

                    <!-- Default Table -->
                    <p style="font-size: 15px; margin-bottom: -1px; font-weight: bold;">List Data Jenis Membership</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;width:50px;">#</th>
                                <th scope="col" style="text-align:center;">Nama Membership</th>
                                <th scope="col" style="text-align:center;width:150px;">Harga</th>
                                <th scope="col" style="text-align:center;width:80px;">Jumlah Voucher</th>
                                <th scope="col" style="text-align:center;width:50px;">Sharing Profit</th>
                                <th scope="col" style="text-align:center;width:50px;">Diskon Produk</th>
                                <th scope="col" style="text-align:center;width:130px;">Periode</th>
                                <th scope="col" style="text-align:center;width:109px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$memberships->isEmpty())
                            @foreach($memberships as $membership)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$membership->nama_membership}}</td>
                                <td style="text-align:right;">Rp{{$membership->harga_membership}}</td>
                                <td>{{$membership->jumlah_voucher}}x</td>
                                <td style="text-align:center;">@if($membership->sharing_profit == 1)
                                    <i class="bi bi-check"></i>
                                    @else
                                    <i class="bi bi-x"></i>
                                    @endif
                                </td>
                                <td>{{$membership->discount_product}}%</td>
                                <td>{{$membership->periode}} {{$membership->satuan_periode}}</td>
                                <td style="text-align:center;">
                                    <a href="" class="badge bg-warning" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#edit{{$membership->id}}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <a href="" class="badge bg-danger" style="width: 40px;" data-bs-toggle="modal"
                                        data-bs-target="#delete{{$membership->id}}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="edit{{$membership->id}}" tabindex="-1">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Jenis Membership</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/update_membership/{{ $membership->id }}">
                                                @method('patch')
                                                {{csrf_field()}}
                                                <div class="col-md-12 mt-2">
                                                    <label for="nama_membership" class="form-label">Nama
                                                        Membership</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_membership') is-invalid @enderror"
                                                        id="nama_membership" name="nama_membership"
                                                        placeholder="Masukkan Nama Membership"
                                                        value="{{$membership->nama_membership}}" required>
                                                    @error('nama_membership')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label for="harga_membership" class="form-label">Harga
                                                            Membership</label>
                                                        <input type="text"
                                                            class="form-control @error('harga_membership') is-invalid @enderror"
                                                            id="harga_membership" name="harga_membership"
                                                            placeholder="Masukkan Harga Membership"
                                                            value="{{$membership->harga_membership}}" required>
                                                        @error('harga_membership')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-2 mt-2">
                                                        <label for="jumlah_voucher" class="form-label">Jumlah
                                                            Voucher</label>
                                                        <input type="text"
                                                            class="form-control @error('jumlah_voucher') is-invalid @enderror"
                                                            id="jumlah_voucher" name="jumlah_voucher"
                                                            placeholder="Masukkan Jumlah Voucher"
                                                            value="{{$membership->jumlah_voucher}}"
                                                            onkeypress="return hanyaAngka(event)" required>
                                                        @error('jumlah_voucher')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-2 mt-2">
                                                        <label for="sharing_profit" class="form-label">Sharing
                                                            Profit</label>
                                                        <br>
                                                        <input class="form-check-input" type="checkbox"
                                                            class="form-control @error('sharing_profit') is-invalid @enderror"
                                                            id="sharing_profit" name="sharing_profit"
                                                            {{$membership->sharing_profit == 1 ? 'checked' : ''}}
                                                            value="1">
                                                        @error('sharing_profit')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-2 mt-2">
                                                        <label for="discount_product" class="form-label">Diskon Produk
                                                            (%)</label>
                                                        <input type="text"
                                                            class="form-control @error('discount_product') is-invalid @enderror"
                                                            id="discount_product" name="discount_product"
                                                            placeholder="Masukkan Diskon Produk"
                                                            value="{{$membership->discount_product}}"
                                                            onkeypress="return hanyaAngka(event)" required>
                                                        @error('discount_product')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mt-2">
                                                        <label for="periode" class="form-label">Periode
                                                            Membership</label>
                                                        <input type="text"
                                                            class="form-control @error('periode') is-invalid @enderror"
                                                            id="periode" name="periode"
                                                            placeholder="Masukkan Periode Membership"
                                                            value="{{$membership->periode}}" required
                                                            onkeypress="return hanyaAngka(event)">
                                                        @error('periode')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mt-2">
                                                        <label for="satuan_periode" class="form-label">Satuan Periode
                                                            Membership</label>
                                                        <select id="satuan_periode" name="satuan_periode"
                                                            class="form-select @error('satuan_periode') is-invalid @enderror"
                                                            required>
                                                            <option disabled value>Pilih Kategori</option>
                                                            <option value="Hari" @if($membership->satua_periode=="Hari")
                                                                selected @endif>Hari</option>
                                                            <option value="Bulan" @if($membership->
                                                                satua_periode=="Bulan") selected @endif>Bulan</option>
                                                            <option value="Tahun" @if($membership->
                                                                satua_periode=="Tahun") selected @endif>Tahun</option>
                                                        </select>
                                                        @error('satuan_periode')
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
                                            <button type="submit" class="btn btn-warning">Edit</button>
                                        </div>
                                        </form><!-- End Multi Columns Form -->
                                    </div>
                                </div>
                            </div> <!-- End Edit Modal -->

                            <div class="modal fade" id="delete{{$membership->id}}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Jenis Membership</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah anda yakin akan menghapus data ini?</p>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Nama
                                                        Membership</label>
                                                    <p>{{$membership->nama_membership}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Harga
                                                        Membership</label>
                                                    <p>Rp{{$membership->harga_membership}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Jumlah
                                                        Voucher</label>
                                                    <p>Rp{{$membership->jumlah_voucher}}</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Sharing
                                                        Profit</label>
                                                    <br>
                                                    <input class="form-check-input" type="checkbox" id="sharing_profit"
                                                        name="sharing_profit" value="1"
                                                        {{$membership->sharing_profit == 1 ? 'checked' : ''}} disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Diskon
                                                        Produk</label>
                                                    <p>{{$membership->discount_product}}%</p>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="inputName5" class="form-label fw-bold">Periode</label>
                                                    <p>{{$membership->periode}} {{$membership->satuan_periode}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{url('delete_membership', $membership->id)}}"
                                                class="btn btn-danger">Delete</i></a>
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
                    {{$memberships->links()}}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
