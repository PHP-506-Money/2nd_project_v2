@extends('layout.layout')

@section('title', 'FIND PASSWORD')

@section('header', 'FIND PASSWORD')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="table" action="{{route('users.findpw.post')}}" method="post">
        @csrf
        <div class="label">
            <label for="id">아이디</label>
            <input type="text" name="id" id="id" autocomplete="off" required>
        </div>
        <div class="label">
            <label for="email">이메일</label>
            <input type="email" name="email" id="email" autocomplete="off" required>
        </div>
            <button type="submit" class="button" id="button">비밀번호 찾기</button>
        <div class="bottom">
            <a href="{{route('users.login')}}" id="down">로그인으로 돌아가기</a>
            <a href="{{route('users.findid')}}" id="down">아이디 찾기</a>
            <a href="{{route('users.registration')}}" id="down">회원가입</a>
        </div>
    </form>
@endsection