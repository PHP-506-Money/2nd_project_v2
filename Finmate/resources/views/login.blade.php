@extends('layout.layout')

@section('title', 'Login')

@section('header', 'LOGIN TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div class=success>{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <form id="table" action="{{route('users.login.post')}}" method="post">
        @csrf
        <div class="label">
            <label for="id">아이디</label>
            <input type="text" name="id" id="id" value="{{ old('id') }}" autocomplete="off" required>
        </div>
        <div class="label">
            <label for="password">비밀번호</label>
            <input type="password" name="password" id="password" required>
        </div>
            <button type="submit" class="button" id="button">로그인</button>
        <div class="bottom">
            <a href="{{route('users.findid')}}" id="down">아이디 찾기</a>
            <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
            <a href="{{route('users.registration')}}" id="down">회원가입</a>
        </div>
    </form>
@endsection