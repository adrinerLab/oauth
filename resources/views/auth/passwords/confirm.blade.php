@extends('layouts.auth')

@section('title', '본인 확인')
@section('message', '보안을 위해 비밀번호 입력이 필요합니다.')

@section('content')
<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <label for="password">비밀번호</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="비밀번호" required autocomplete="current-password">
    @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <button type="submit" class="btn btn-primary btn-block mt-4 mb-2 rounded-pill">비밀번호 확인</button>

    @if (Route::has('password.request'))
        <a class="float-right" href="{{ route('password.request') }}">비밀번호를 잊으셨나요?</a>
    @endif
</form>
@endsection
