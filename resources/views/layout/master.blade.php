<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'COSSMIL - Telexperticia')</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="_token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css" rel="stylesheet">
  <!-- end plugin css -->

  @stack('plugin-styles')

  <!-- common css -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
  <!-- end common css -->

  @stack('style')
</head>
<body data-base-url="{{url('/')}}">

  <script src="{{ asset('assets/js/spinner.js') }}"></script>

  <div class="main-wrapper" id="app">
  @include('layout.header')
    <div class="page-wrapper">
      <div class="page-content">
        @yield('content')
      </div>
      @stack('scripts')

      <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

      @if (session()->has('success'))
      <script>
          const notyf = new Notyf({
              dismissible: true,
              duration: 10000,
              position: {x:'center',y: 'top',}
            })
          notyf.success('{{ session('success') }}')
      </script>
      @endif

      @if (session()->has('error'))
          <script>
              const notyf = new Notyf({dismissible: true, duration: 10000})
              notyf.error('{{ session('error') }}')
          </script>
      @endif

      <script>
          /* Simple function to retrieve data url from file */
          function fileToDataUrl(event, callback) {
              if (! event.target.files.length) return

              let file = event.target.files[0],
                  reader = new FileReader()

              reader.readAsDataURL(file)
              reader.onload = e => callback(e.target.result)
          }
      </script>
      @include('layout.footer')
    </div>
  </div>

    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <!-- end base js -->

    <!-- plugin js -->
    @stack('plugin-scripts')
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- end common js -->

    @stack('custom-scripts')

</body>
</html>
