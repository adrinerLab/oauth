@extends('layouts.auth')

@section('title', '이메일 인증')

@section('content')
    @if (!session('resent'))
        <div class="alert alert-success" role="alert">새로운 인증 링크를 메일로 보냈어요!</div>
    @endif

    <p>모든 기능을 이용하려면 이메일 인증을 해주세요!</p>
    <p>메일을 받지 못하셨다면 아래의 버튼을 누르세요.</p>

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-block btn-outline-dark rounded-pill">인증메일 다시 받기</button>
    </form>
@endsection
