<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{asset('')}}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    {{--Img--}}
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="admin_assets/img/apple-icon.png"> -->
    <link rel="icon" type="image/png" href="images/favicon/cinema.png ">
    <title>
        Admin Cinema
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="admin_assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="admin_assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font awesome - icon font -->
    <link href="/web_assets/fonts/fontawesome/css/all.css" rel="stylesheet" />
    <link href="admin_assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- CSS Files -->
    <link id="pagestyle" href="admin_assets/css/argon-dashboard.css" rel="stylesheet" />
    {{--Select2--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Sweetalert2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.css" integrity="sha512-K0TEY7Pji02TnO4NY04f+IU66vsp8z3ecHoID7y0FSVRJHdlaLp/TkhS5WDL3OygMkVns4bz0/ah4j8M3GgguA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .dropdown .dropdown-menu.show:before {
            top: -11px !important;
            position: absolute !important;
        }

        @yield('css')
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">

    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('admin.layout.sidebar')
    <main class="main-content position-relative border-radius-lg">
        <!-- Navbar -->
        @include('admin.layout.nav')
        <!-- End Navbar -->
        @if(count($errors) > 0)
        <div class="alert alert-warning">
            @foreach($errors->all() as $arr)
            {{ $arr }}<br>
            @endforeach
        </div>
        @endif
        @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
        @endif
        @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>Success!</strong> {{ session('success') }}!</span>
        </div>
        @endif
        @yield('content')

    </main>




    <!--   Core JS Files   -->
    <script src="admin_assets/js/core/popper.min.js"></script>
    <script src="admin_assets/js/core/bootstrap.min.js"></script>
    <script src="admin_assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="admin_assets/js/plugins/smooth-scrollbar.min.js"></script>


    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Control Center for Argon Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="admin_assets/js/argon-dashboard.min.js"></script>

    {{-- Jquery --}}
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!--   Moris   -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    {{-- Select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js" integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ==" crossorigin="anonymous"></script>



    {{-- ScanbotSDK --}}

    <script src="https://cdn.jsdelivr.net/npm/scanbot-web-sdk@latest/bundle/ScanbotSDK.min.js"></script>
    <!-- After, initialize the Scanbot SDK in your own script -->

    <script src="admin_assets/scanbotSDK/js/lib/toastify.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/vn.js"></script>

    <script src="admin_assets/scanbotSDK/js/lib/toastify.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.js" integrity="sha512-ywT1Sl8B8rJwwBWFC3rPTu/VQkDrnS19Kw0Xxa6Y9xvzMSwVMHDQscePPR9yNE0oyVsITEcvUPSDW/aS5KX+Mw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--Firebase database--}}

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    {{-- CKeditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                if (!error)
                    console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#conditions'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                if (!error)
                    console.error(error);
            });
    </script>
    <!-- Insert this script at the bottom of the HTML, but before you use any Firebase services -->
    <script type="module">
        import {
            initializeApp
        } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-app.js'

        import {
            getDatabase,
            ref,
            onValue,
            set
        } from 'https://www.gstatic.com/firebasejs/10.0.0/firebase-database.js'

        const firebaseConfig = {
            apiKey: "{{config('services.firebase.apiKey')}}",
            authDomain: "{{config('services.firebase.authDomain')}}",
            projectId: "{{config('services.firebase.projectId')}}",
            storageBucket: "{{config('services.firebase.storageBucket')}}",
            messagingSenderId: "{{config('services.firebase.messagingSenderId')}}",
            appId: "{{config('services.firebase.appId')}}",
            measurementId: "{{config('services.firebase.measurementId')}}",
            databaseURL: "{{config('services.firebase.databaseURL')}}"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        // Initialize Realtime Database and get a reference to the service
        const db = getDatabase(app);

        // function writeUserData(userId, name, email, imageUrl) {
        //     set(ref(db, 'users/' + userId), {
        //         username: name,
        //         email: email,
        //         profile_picture : imageUrl
        //     });
        // }

        // writeUserData('2', 'ssMinh', 'minh@gmail.com', 'huungu');
        // const element = document.getElementById("test");
        // const starCountRef = ref(db, 'users/' + 2 );
        // onValue(starCountRef, (snapshot) => {
        //     const data = snapshot.val();
        //     $("#test").text(data.username);
        // });
    </script>
    @yield('scripts')

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-KXyjeIN8zhJ9J3D6KkLk9yc/zfRuFjPRAyCkkxgPny8=" crossorigin="anonymous"></script>

</html>