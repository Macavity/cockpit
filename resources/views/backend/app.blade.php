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
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>

<div class="container">
  <div class="content">
    <app>
      @include('backend.partials.loading')
    </app>
  </div>
</div>

@include('backend.partials.scripts')

@include('backend.partials.livereload')
</body>
</html>
