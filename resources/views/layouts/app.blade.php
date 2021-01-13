<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title') @yield('title') :: @endif {{ config('app.name') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="app">
    @include('components.navbar')
    @include('components.hero')
    <div class="container">
        @yield('content')
    </div>
    @include('sweetalert::alert')
</body>
</html>
