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
  <link rel="icon" type="image/x-icon" href="{{asset('static/assets/img/favicon/favicon.png')}}" />

  <!-- FONTS 
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
  rel="stylesheet"/>
  -->

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{asset('static/assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('static/assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('static/assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('static/assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('static/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

  <!-- Helpers -->
  <script src="{{asset('static/assets/vendor/js/helpers.js')}}"></script>

  <!--Sweetalert-->
  <script src="{{ asset('static/js/sweetalert.min.js') }}"></script>

      @livewireStyles

  </head>
  <body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!--NAVBAR-->
          @include('partials.dashboard.navbar')
          <!--END NAVBAR-->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">

                <!--Alerts-->
                @include('partials.others.alert')
                <!-- end of alert -->

                <!--Content-->
                @yield('content')
                <!--End content-->

                <!--Livewire gemini chat-->
                @livewire('gemine')
                <!--End livewire gemini chat-->

                <!-- Content wrapper -->
              </div>
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('static/assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('static/assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('static/assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('static/assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{asset('static/assets/js/main.js')}}"></script>

    <!--Logout JS-->
    <script src="{{asset('static/js/config.js')}}"></script>

    <!--CHARJS-->
    <script src="{{asset('static/js/chart.js')}}"></script>

    @livewireScripts

    <!--Extra script-->
    @yield('script')
    <!--End script-->

</body>
</html>