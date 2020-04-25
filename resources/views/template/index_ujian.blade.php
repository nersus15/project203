<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <script src="{!! asset('js/app.js') !!}"></script>
    <script src="{!! asset('vendor/JqueryForm/js/jquery.form.js') !!}"></script>
    <script>
        var path = window.location.origin;
    </script>
    <title>Latihan CRUD | Web Service</title>
</head>
<body>
   <h1> @yield('page_heading') </h1>
   <div class="container">
       <div class="row">
            <h3>@yield('konten1_heding')</h3>
            @yield('datatable')
       </div>
   </div>
    @foreach($modalid as $k)
        @yield($k)
    @endforeach

</body>
</html>