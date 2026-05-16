<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Blue Orange ERP')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="guest-body">

<div class="guest-page">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
