@extends('layouts.auth')

@section('title', '비밀번호 재설정')
@section('message', '비밀번호 재설정을 위한 링크를 보내드립니다.')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <label for="email">이메일</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="이메일" required autocomplete="email" autofocus>
    @error('email') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

    <button type="submit" class="btn btn-primary btn-block mt-4 mb-2 rounded-pill">이메일 전송하기</button>
</form>
@endsection
