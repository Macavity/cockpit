<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Cockpit</title>
  <base href="/"/>
  @include('backend.partials.styles')
</head>
<body>

<app>
  @include('backend.partials.loading')
</app>

@include('backend.partials.scripts')

@include('backend.partials.livereload')
</body>
</html>
