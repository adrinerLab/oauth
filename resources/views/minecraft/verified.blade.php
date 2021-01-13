@extends('layouts.auth')

@section('title', '정품 인증 결과')

@section('content')
    <h3 class="text-success font-weight-bold text-center">정품 입니다</h3>
    <h6 class="text-muted text-center">{{ \Carbon\Carbon::now()->format('Y년 m월 d일 h시 i분 s초') }} 확인 결과입니다.</h6>
    <hr>
    <h4 class="font-ns">{{ \Illuminate\Support\Str::ucfirst($verified['auth_type']) }} 계정으로 인증되었습니다.</h4>
    <p>인증결과는 자동으로 adrinerLab 계정과 연동되니, 다양한 서비스에서 인증 결과를 활용 해보세요!</p>
    <hr>
    <a href="{{ route('minecraft.gate') }}" class="btn btn-block btn-primary btn-lg mt-4 rounded-pill">정품인증 홈</a>
@endsection
