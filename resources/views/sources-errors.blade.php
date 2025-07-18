<!DOCTYPE html>
<html lang="es" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>

  <!--META-->
  <meta charset="utf-8" />
  <mete name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
  <meta name="description" content="" />
  
  <!--TITLE-->
  @yield('title')

  <!-- FAVICON -->
  <link rel="icon" type="image/x-icon" href="{{asset('static/assets/img/favicon/favicon.ico')}}" />

  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"/>

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{asset('static/assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('static/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('static/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('static/assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('static/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="{{asset('static/assets/vendor/css/pages/page-auth.css')}}" />

  <!-- Helpers -->
  <script src="{{asset('static/assets/vendor/js/helpers.js')}}"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('static/assets/js/config.js')}}"></script>

    <!--Sweetalert-->
    <script src="{{ asset('static/js/sweetalert.min.js') }}"></script>

  </head>
  <body>

    <!--Alerts-->
    @include('partials.others.alert')

    <div class="container-xxl container-p-y">
      <div class="misc-wrapper text-center">

        @yield('content')

      </div>
    </div>

    <!-- Core JS -->

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('static/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('static/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('static/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('static/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('static/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{asset('static/assets/js/main.js')}}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
  </html>




