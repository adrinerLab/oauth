@extends('layouts.auth')

@section('title', '비밀번호 재설정')
@section('message', '')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <label for="email">이메일</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="이메일" required autocomplete="email" autofocus>
    @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <div id="password">
        <label for="password">비밀번호</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="비밀번호" required autocomplete="new-password">
        @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
    </div>

    <div id="password-confirm">
        <label for="password-confirm">비밀번호 확인</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="비밀번호 확인" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary btn-block mt-4 mb-2 rounded-pill">비밀번호 재설정</button>
</form>
@endsection
