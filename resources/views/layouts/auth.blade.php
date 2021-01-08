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
<body id="auth">
<div class="wrapper">
    <main>
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('/logo.png') }}" alt="adrinerLab Logo">
                <h1 class="service-name">인증센터</h1>
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <h2 class="title">@yield('title', 'adrinerLab')</h2>
                <p class="message">@yield('message', 'adrinerLab OneID 시스템에 오신 것을 환영합니다!')</p>
                @yield('content')
            </div>
            <div class="card-footer text-center">
                <a href="#">이용약관</a> · <a href="#" style="font-weight:900">개인정보처리방침</a>
            </div>
        </div>
    </main>
</div>
@include('sweetalert::alert')
</body>
</html>
