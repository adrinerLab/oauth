<div class="hero">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-md-12">
                <h1>@yield('title', config('app.name'))</h1>
                <p>@yield('message', 'adrinerLab OneID 시스템에 오신 것을 환영합니다!')</p>
            </div>
            <div class="col-xl-3 d-xl-block d-none">
                <img src="{{ asset('images/authenticate.svg') }}" class="w-75 d-block ml-auto">
            </div>
        </div>
    </div>
</div>
