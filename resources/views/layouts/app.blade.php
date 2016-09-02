<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <base href="/">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <script>
    window.APP_ENVIRONMENT = {
      APP_ENV: '{{ env('APP_ENV') }}',
      API_STANDARDS_TREE: '{{ env('API_STANDARDS_TREE') }}',
      API_SUBTYPE: '{{ env('API_SUBTYPE') }}',
      API_VERSION: '{{ env('API_VERSION') }}',
    };
    window.Laravel = {csrfToken: '{{ csrf_token() }}'};
  </script>
  <title>{{ $title or "Cockpit"}}</title>

  <!-- Fonts -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
        type='text/css'>
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

  <!-- Styles -->
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/icomoon.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

  @include('partials.scripts')

  <style>
    body {
      font-family: 'Lato';
    }
  </style>
</head>
<body>

  @section('content')
    @include('partials.navbar')
    @include('partials.frontend_app')
  @show

</body>
</html>
