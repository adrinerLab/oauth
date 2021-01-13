@extends('layouts.auth')

@section('title', '마인크래프트 정품인증')
@section('message', '')

@section('content')
    <img src="{{ asset('/images/minecraft.png') }}" class="w-75 mx-auto d-block mb-4" alt="Minecraft Logo">

    <h6 class="mb-4 text-center">adrinerLab에서 <strong>마인크래프트 정품 인증</strong>하세요!</h6>

    <a href="{{ route('minecraft.microsoft.consent') }}" class="btn btn-block btn-lg btn-dark mb-3">
        <img src="{{ asset('/images/microsoft.svg') }}" style="height:1.4rem;margin-top:-3px"> 계정으로 로그인
    </a>
    <a href="{{ route('minecraft.mojang.consent') }}" class="btn btn-block btn-sm btn-danger mb-3 font-ns">
        MOJANG 계정으로 로그인
    </a>
@endsection
