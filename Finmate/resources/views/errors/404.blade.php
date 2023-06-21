@extends('layout.layout')

@section('title', '404 NOT FOUND')

@section('header', '404 NOT FOUND')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <form id="table">
        @csrf
        <div class="label4">
            <label for="password">잘못된 경로로 접속하셨습니다.</label>
        </div>
        <div class="bottom">
            @auth
                <a href="{{ url('/assets'.'/' . auth()->user()->userid) }}" id="down">메인 페이지로 돌아가기</a>
            @endauth
            @guest
                <a href="{{ route('main') }}" id="down">메인 페이지로 돌아가기</a>
            @endguest
        </div>
    </form>
@endsection