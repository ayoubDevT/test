<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Test</title>
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- core:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/prismjs/themes/prism.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
  <!-- endinject -->
  <link rel="stylesheet" id="csss" href="{{ Session::get('dark') ?? asset('assets/css/demo_1/style.min.css') }}">
  <!-- Layout styles -->
  <!-- End layout styles -->
  <link rel="icon" href="{{ asset('assets/images/favicon-32x32.jpg') }}" />
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
  <link rel="stylesheet" id="csss" href="{{ asset('assets/css/css.css') }}">

</head>


<body>
  <div class="main-wrapper">






    {{ $slot }}



  </div>
  <!-- core:js -->
  <script src="{{ asset('assets/vendors/core/core.js') }}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->

  <script src="{{ asset('assets/vendors/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/vendors/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/vendors/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/vendors/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/promise-polyfill/polyfill.min.js') }}"></script>
  <!-- end plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- custom js for this page -->
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>

  <!-- check if the user registred successfully -->
  @if(Session::get('alert') == 'set')
  <script>
    alert('you successfully registered ')
  </script>
  @php
  Illuminate\Support\Facades\Session::forget('alert');
  @endphp
  @endif

  

</body>

</html>