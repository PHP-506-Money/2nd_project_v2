@extends('layout.layout')

@section('title', 'FindID')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div>{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <form id="table" action="" method="post">
        @csrf
        <div class="label">
            <label for="name">이름</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="label">
            <label for="email">이메일</label>
            <input type="email" name="email" id="email">
        </div>
            <button type="submit" class="button" id="button">아이디 찾기</button>
        <div class="bottom">
            <a href="{{route('users.login')}}" id="down">로그인으로 돌아가기</a>
            <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
            <a href="{{route('users.registration')}}" id="down">회원가입</a>
        </div>
    </form>
@endsection