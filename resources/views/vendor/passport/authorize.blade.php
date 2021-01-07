@extends('layouts.auth')

@section('title', '앱 인증')
@section('message', '사용자 정보 제공을 위해 확인해주세요.')

@php
$scopes = ['Place orders', 'Check order status']
@endphp

@section('content')
    <div class="mb-5 border-bottom" id="information">
        <h4 class="font-weight-bold text-center">{{ $client->name }}</h4>
        <p class="text-center">사용자 정보 제공 요청 확인이 필요합니다.</p>
    </div>

    @if (count($scopes) > 0)
        <div class="scopes">
            <h6>아래의 작업을 수행할 수 있습니다.</h6>

            <ul class="pl-3 mt-2 mb-5">
                @foreach ($scopes as $scope)
{{--                    <li>{{ $scope->description }}</li>--}}
                    <li>{{ $scope }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="buttons">
        <form method="post" action="{{ route('passport.authorizations.approve') }}">
            @csrf
            <input type="hidden" name="state" value="{{ $request->state }}">
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="auth_token" value="{{ $authToken }}">
            <button type="submit" class="btn btn-primary btn-block btn-lg rounded-pill w-75 mx-auto btn-approve">승인</button>
        </form>
        <form method="post" action="{{ route('passport.authorizations.deny') }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="state" value="{{ $request->state }}">
            <input type="hidden" name="client_id" value="{{ $client->id }}">
            <input type="hidden" name="auth_token" value="{{ $authToken }}">
            <button class="btn btn-outline-danger btn-block btn-sm rounded-pill w-50 mx-auto mt-2">취소하기</button>
        </form>
    </div>
@endsection
