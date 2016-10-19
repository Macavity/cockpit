<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title or "Cockpit"}}</title>

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">

  <!-- Scripts -->
  <script>
    window.APP_ENVIRONMENT = {
      APP_ENV: '{{ env('APP_ENV') }}',
      API_STANDARDS_TREE: '{{ env('API_STANDARDS_TREE') }}',
      API_SUBTYPE: '{{ env('API_SUBTYPE') }}',
      API_VERSION: '{{ env('API_VERSION') }}'
    };
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
  </script>
</head>
<body>
<div id="app">

  @section('content')
    @include('partials.navbar')
    @include('partials.frontend_app')
  @show
</div>

@include('partials.scripts');

<!-- Fonts -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

</body>
</html>
