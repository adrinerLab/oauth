@extends('layouts.auth')

@section('title', '정품 인증 결과')

@section('content')
    <h3 class="text-danger font-weight-bold text-center">정품이 아닙니다</h3>
    <h6 class="text-muted text-center">{{ \Carbon\Carbon::now()->format('Y년 m월 d일 h시 i분 s초') }} 확인 결과입니다.</h6>
    <a href="{{ route('minecraft.gate') }}" class="btn btn-block btn-primary btn-lg mt-4 rounded-pill">정품인증 홈</a>
@endsection
