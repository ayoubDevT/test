<!DOCTYPE html>
<!--
Template Name: NobleUI - Admin & Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: You must have a valid license purchased only from above link or https://themeforest.net/user/nobleui/portfolio/ in order to legally use the theme for your project.
-->
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
  <link rel="stylesheet" href="{{ asset('assets/vendors/owl.carousel/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/owl.carousel/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/animate.css/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/dropify/dist/dropify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/prismjs/themes/prism.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/select2/select2.min.css') }}">

  <!-- end plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" id="csss" href="{{ Session::get('dark') ?? asset('assets/css/demo_1/style.min.css') }}">
  <!-- End layout styles -->
  <link rel="icon" href="{{ asset('assets/images/favicon-32x32.jpg') }}" />
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
  <link rel="stylesheet" id="csss" href="{{ asset('assets/css/css.css') }}">

</head>
<style>
  .center {
    margin: auto;
    width: 50%;
    padding: 10px;
  }

  .img-width {
    width: 50%;
  }
</style>

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
  <script src="{{ asset('assets/vendors/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/vendors/clipboard/clipboard.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/select2/select2.min.js') }}"></script>
  <!-- end plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- custom js for this page -->
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/carousel.js') }}"></script>
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>


  <script>
    $('#varyingModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    })
  </script>

</body>

</html>