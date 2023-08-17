@extends('layout.adminlayout')

@section('title', 'ASA Hospitality | Dashboard')

@section('container')

<div class="pagetitle">
    <h1>Dashboard</h1>
</div><!-- End Page Title -->

<section class="section dashboard">

    <!-- Left side columns -->
    <div class="col-lg-12">
        <div class="row">

            <!-- Sales Card -->
            <div class="col-md-3">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Total Registrasi</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-file-earmark"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$regs}}</h6>
                                <span class="text-muted small pt-2 ps-1">Registrasi</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Sales Card -->

            <!-- Customers Card -->
            <div class="col-md-3">

                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Registrasi Terverifikasi</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-envelope-check"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$members}}</h6>
                                <span class="text-muted small pt-2 ps-1">Registrasi</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- End Customers Card -->

            <!-- Revenue Card -->
            <div class="col-md-3">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Member Pasif</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-dash-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$nonmembers}}</h6>
                                <span class="text-muted small pt-2 ps-1">User</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-md-3">

                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Member Aktif</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{$members}}</h6>
                                <span class="text-muted small pt-2 ps-1">User</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div><!-- End Customers Card -->

        </div>

        <!-- Top Selling -->
        <div class="col-12">
            <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">
                    <h5 class="card-title">Total Membership</h5>

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Membership</th>
                                <th scope="col" style="width: 150px;">Price</th>
                                <th scope="col" style="width: 150px;">Registrasi</th>
                                <th scope="col" style="width: 150px;">Belum Resmi</th>
                                <th scope="col" style="width: 150px;">Resmi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($memberships as $members)
                            <tr>
                                <td>{{$members->nama_membership}}</td>
                                <td>{{$members->harga_membership}}</td>
                                <td>{{$members->total_reg}}</td>
                                <td>{{$members->total_pasif}}</td>
                                <td>{{$members->total_aktif}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div><!-- End Top Selling -->

    </div><!-- End Left side columns -->

</section>

@endsection
