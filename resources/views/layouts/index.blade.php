<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>Student Management System</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('css/datatables/datatables.min.css') }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @yield('top-script')
    </head>

    <body>
        <main id="main" class="main p-3">
            @yield('content')
        </main>
    </body>
    <script src="{{ URL::asset('/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('/js/datatables/datatables.min.js') }}"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.1.1/dist/flasher.min.js"></script>
    @yield('script')
</html>
