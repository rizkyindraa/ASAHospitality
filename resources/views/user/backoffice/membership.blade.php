@extends('layout.useradminlayout')

@section('title', 'ASA Hospitality | Membership')

@section('container')

<div class="pagetitle">
    <h1>Membership</h1>
</div><!-- End Page Title -->

<section class="section membership">

    <div class="col-md-12">

        <div class="card">
            <div class="card-body membership-title pt-2 pb-2">
                <h5 class="title">{{$membership->nama_membership}}</h5>
            </div>
            <div class="card-body membership-body pt-3 d-flex flex-column">
                <h5 class="card-title">Membership Detail</h5>
                <div class="row mb-3">
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Harga</div>
                        <div class="col-lg-6">{{$membership->harga_membership}}</div>
                    </div>
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Periode</div>
                        <div class="col-lg-6">{{$membership->periode}} {{$membership->satuan_periode}}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Voucher</div>
                        <div class="col-lg-6"><span id="voucher">{{$membership->jumlah_voucher}}</span>x</div>
                    </div>
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Sharing Profit</div>
                        @if($membership->sharing_profit == 1)
                        <div class="col-lg-6"><i class="bi bi-check"></i></div>
                        @else
                        <div class="col-lg-6"><i class="bi bi-x"></i></div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Diskon Produk</div>
                        <div class="col-lg-6">{{$membership->discount_product}}%</div>
                    </div>
                </div>
            </div>
            <div class="card-body membership-body pt-3 d-flex flex-column">
                <h5 class="card-title">Membership Status</h5>
                <div class="row mb-3">
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Status Penerimaan Membership</div>
                        @if($reg->status_penerimaan_membership == 1)
                        <div class="col-lg-6"><span style="color: #2bc740;margin:0;">Member Aktif</span></div>
                        @elseif($reg->status_penerimaan_membership == 2)
                        <div class="col-lg-6"><span style="color: #cc271f;margin:0;">Batal Member</span></div>
                        @elseif($reg->status_penerimaan_membership == 0)
                        <div class="col-lg-6"><span style="color: #393a39;margin:0;">Member Pasif</span></div>
                        @endif
                    </div>
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Payment</div>
                        @if(is_null($reg->payment))
                        <div class="col-lg-6">-</div>
                        @else
                        <div class="col-lg-6">{{$reg->payment}}</div>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Tgl. Awal Membership</div>
                        @if(is_null($reg->tgl_penerimaan_membership))
                        <div class="col-lg-6">-</div>
                        @else
                        <div class="col-lg-6">{{Carbon\Carbon::parse($reg->tgl_penerimaan_membership)->isoFormat('dddd, D MMMM Y')}}</div>
                        @endif
                    </div>
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Tgl. Akhir Membership</div>
                        @if(is_null($reg->tgl_penerimaan_membership))
                        <div class="col-lg-6">-</div>
                        @else
                            @if($membership->satuan_periode == "Tahun")
                            <div class="col-lg-6">{{Carbon\Carbon::parse($reg->tgl_penerimaan_membership)->addYears($membership->periode)->isoFormat('dddd, D MMMM Y')}}</div>
                            @elseif($membership->satuan_periode == "Minggu")
                            <div class="col-lg-6">{{Carbon\Carbon::parse($reg->tgl_penerimaan_membership)->addWeeks($membership->periode)->isoFormat('dddd, D MMMM Y')}}</div>
                            @else
                            <div class="col-lg-6">{{Carbon\Carbon::parse($reg->tgl_penerimaan_membership)->addDays($membership->periode)->isoFormat('dddd, D MMMM Y')}}</div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Sisa Waktu Membership</div>
                        @if(is_null($reg->tgl_penerimaan_membership))
                        <div class="col-lg-6">0 Hari</div>
                        @else
                            @if($membership->satuan_periode == "Tahun")
                            <div class="col-lg-6"><span id="sisa">{{Carbon\Carbon::parse($reg->tgl_penerimaan_membership)->addYears($membership->periode)->diffInDays(now())}}</span> Hari</div>
                            @elseif($membership->satuan_periode == "Minggu")
                            <div class="col-lg-6"><span id="sisa">{{Carbon\Carbon::parse($reg->tgl_penerimaan_membership)->addWeeks($membership->periode)->diffInDays(now())}}</span> Hari</div>
                            @else
                            <div class="col-lg-6"><span id="sisa">{{Carbon\Carbon::parse($reg->tgl_penerimaan_membership)->addDays($membership->periode)->diffInDays(now())}}</span> Hari</div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Voucher Terpakai</div>
                        <div class="col-lg-6"><span id='voucher-used'>{{$vouchers->count()}}</span> Voucher</div>
                    </div>
                    <div class="row col-lg-6">
                        <div class="col-lg-6 label">Sisa Voucher</div>
                        <div class="col-lg-6"><span id='sisa-voucher'></span> Voucher</div>
                    </div>
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
