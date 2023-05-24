<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('template/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('template/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('template/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('template/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  @routes
  @inertiaHead
  @vite('resources/js/app.js')
</head>

<body class="g-sidenav-show bg-gray-100">
  @inertia
  <!--   Core JS Files   -->
  <script src="{{ asset('template/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('template/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('template/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('template/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('template/js/plugins/chartjs.min.js') }}"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('template/js/argon-dashboard.min.js?v=2.0.4') }}" defer></script>
</body>

</html>
