<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('title')

        <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap-3.3.7-dist/bootstrap.min.css')}} ">
        <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap-3.3.7-dist/bootstrap-theme.min.css')}} ">
        <link rel="stylesheet" href="{{ URL::asset('/css/dataTables.bootstrap.css')}} ">
        <link rel="stylesheet" href="{{ URL::asset('/css/colorbox.css')}} ">
        <link rel="stylesheet" href="{{ URL::asset('/css/custom.css')}}" type='text/css'>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/redmond/jquery-ui.css">

        <script src="{{ URL::asset('/js/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ URL::asset('/js/bootstrap-3.3.7-dist/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/js/DataTables-1.10.16/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('/js/DataTables-1.10.16/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/js/jquery.colorbox-min.js') }}"></script>  
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>
    <body>
        @include('layouts.menu')
        @yield('content')
        @stack('scripts')     
    </body>
</html>