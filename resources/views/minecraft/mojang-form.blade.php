@extends('layouts.auth')

@section('title', 'MOJANG 로그인')
@section('message', 'adrinerLab은 계정 정보를 저장하지 않습니다.')

@section('content')
    <form action="{{ route('minecraft.mojang.callback') }}" method="POST">
        @csrf

        @if(session('error'))
            <div class="alert alert-danger mb-3 p-2">
                <h4>사용자를 찾을 수 없습니다!</h4>
                <p class="m-0">사용자명이나 비밀번호가 올바른지 확인해주세요.</p>
            </div>
        @endif

        <label for="username">사용자명 (아이디 또는 이메일)</label>
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
               value="{{ old('username') }}" placeholder="아이디 또는 이메일" required autocomplete="username" autofocus>
        @error('username') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

        <label for="password">비밀번호</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
               name="password" placeholder="비밀번호" required autocomplete="current-password">
        @error('password') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror

        <button type="submit" class="btn btn-block btn-lg btn-danger mt-4 mb-3 font-ns rounded-pill">
            MOJANG 계정으로 로그인
        </button>
    </form>
@endsection
