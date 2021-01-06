@extends('layouts.auth')

@section('title', '회원가입')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">이름</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="이름" required autocomplete="name" autofocus>
    @error('name') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <label for="email">이메일</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="이메일" required autocomplete="email">
    @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <label for="password">비밀번호</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="비밀번호" required autocomplete="new-password">
    @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <label for="password-confirm">비밀번호 확인</label>
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="비밀번호 확인" required autocomplete="new-password">

    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4 rounded-pill">회원가입</button>
</form>
@endsection
