<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="Paralympic Committee of India — empowering para athletes and sharing news, events and athletes information." />
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @include('sweetalert::alert')


  <!-- Preconnect to common CDNs if you use them (commented out as optional) -->
  <!-- <link rel="preconnect" href="https://images.unsplash.com"> -->

    @yield('styling')
</head>
    <body class="@yield('body-class', '')">
        @yield('mainContent')
    </body>
</html>