<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

      <!-- 1. Load libraries -->
      <!-- Polyfill(s) for older browsers -->
      <script src="/core-js/client/shim.min.js"></script>
      <script src="/zone.js/dist/zone.js"></script>
      <script src="/reflect-metadata/Reflect.js"></script>
      <script src="/systemjs/dist/system.src.js"></script>
      <!-- 2. Configure SystemJS -->
      <script src="/systemjs.config.js"></script>
      <script>
        System.import('app').catch(function(err){ console.error(err); });
      </script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
                <app>Lädt...</app>
            </div>
        </div>
    </body>
</html>
