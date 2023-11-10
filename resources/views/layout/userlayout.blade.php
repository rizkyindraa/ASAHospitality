<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/asamini.png')}}" rel="icon">
    <link href="{{asset('assets/asamini.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>

    <!-- Vendor CSS Files -->
    <link href="{{asset('User/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('User/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('User/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('User/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('User/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('User/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('User/assets/vendor/aos/aos.css')}}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Template Main CSS File -->
    <link href="{{asset('User/assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

    <!-- ======= Header/Navbar ======= -->
    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
        <div class="container">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false"
                aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a class="navbar-brand text-brand" href="{{route('home')}}"><img src="{{asset('assets/asalogo.png')}}" alt
                    class="logo"></a>

            <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest_work')}}">How We Work</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">The Villas</a>
                        <div class="dropdown-menu">
                            @foreach($villas as $villa)
                            <a class="dropdown-item " href="{{url('villa-list', $villa->id)}}">{{$villa->nama_villa}}</a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest_here')}}">How to Get Here</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest_facility')}}">Facilities</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('membership')}}">Membership</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest_about')}}">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('guest_contact')}}">Contact Us</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav><!-- End Header/Navbar -->

    <main id="main">

        @yield('container')

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <section class="section-footer">
        <div class="container">
            <img src="{{asset('assets/asalogo.png')}}" alt class="logo">
            <p>{{$contact->villa_address}}</p>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="socials-a">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a target="_blank" href="https://api.whatsapp.com/send?phone=62{{$contact->phone}}">
                                    <i class="bi bi-telephone" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a target="_blank" href="https://mail.google.com/mail/?view=cm&fs=1&to={{$contact->email}}">
                                    <i class="bi bi-envelope" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="copyright-footer">
                        <p class="copyright color-text-a">
                            &copy; Copyright
                            <span class="color-a">ASA Hospitality</span> All Rights Reserved.
                        </p>
                    </div>
                    <div class="credits">
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End  Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{asset('User/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('User/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('User/assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('User/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('User/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script>
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });

    </script>

    <!-- Template Main JS File -->
    <script src="{{asset('User/assets/js/main.js')}}"></script>

</body>

</html>
