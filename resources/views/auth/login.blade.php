@extends('layouts.auth')

@section('title', '로그인')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email">이메일</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
           value="{{ old('email') }}" placeholder="이메일" required autocomplete="email" autofocus>
    @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <label for="password">비밀번호</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
           name="password" placeholder="비밀번호" required autocomplete="current-password">
    @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    <label class="mb-3" for="remember">로그인 유지하기</label>

    <button type="submit" class="btn btn-primary btn-lg btn-block mt-3 mb-2 rounded-pill">로그인</button>

    @if (Route::has('register'))
        <a class="btn btn-secondary btn-sm btn-block mb-2 rounded-pill" href="{{ route('register') }}">회원가입</a>
    @endif

    @if (Route::has('password.request'))
        <a class="float-right" href="{{ route('password.request') }}">비밀번호를 잊으셨나요?</a>
    @endif

</form>
@endsection
