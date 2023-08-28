<!DOCTYPE html>
<html lang="id">

<head>
    <title>ASA Hospitality E-Voucher</title>
</head>

<body>
    <section style="padding-top: 10px; background: #a67644; padding-bottom: 5px; margin-bottom: 20px;">
            <p style="text-align: center; font-size: 25px; font-weight:bold; color:#f1ece7;">{{$title}}</p>
    </section>

    <!-- ======= Voucher ======= -->
    <section style="padding-top: 20px; margin-top: 40px; background: #f1ece7; padding-bottom: 5px; border-radius: 40px 40px 0px 0px; border-bottom: 2px solid #ddd;">
        <div class="container">
            <img src="{{public_path('assets/asalogo.png')}}" style="display:block; margin-left:250px; width:200px;" alt>
            <p style="text-align: center; font-size: 13px;">Voucher No. {{$no_voucher}} - Voucher Date {{$tgl_voucher}}</p>
        </div>
    </section>
    <section style="background: #f1ece7;">
        <div class="container">
            <p style="text-align: center; font-size: 24px;">One Night Stay Gift Voucher</p>
            <p style="text-align: center; font-size: 18px;">At Svarga Renjana Villa</p>
            <p style="text-align: center; font-size: 15px;">On Behalf Of Mr/Mrs {{$penerima}}</p>
        </div>
    </section>
    <footer style="background: #f1ece7; text-align: center; padding: 5px 0; border-radius: 0px 0px 40px 40px; border-top: 2px solid #ddd;" >
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-footer" style="padding-top: 10px;">
                        <p style="text-align: center; font-size: 15px;">Desa Aik Berik, Batu Keliang Utara, Lombok Tengah Nusa Tenggara Barat.</p>
                        <p class="copyright color-text-a">
                            &copy; Copyright
                            <span class="color-a">ASA Hospitality</span> All Rights Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End  Voucher -->

</body>

</html>