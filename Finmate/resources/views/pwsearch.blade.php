@extends('layout.layout')

@section('title', 'Login')

@section('contents')
    <h1>LOGIN</h1>
    <p></p>
    @include('layout.errorsvalidate')
    <div>{!!session()->has('success') ? session('success') : ""!!}</div>
    <form action="" method="post">
        @csrf
        <label for="id">아이디</label>
        <input type="text" name="id" id="id">
        <p></p>
        <label for="email">이메일</label>
        <input type="email" name="email" id="email">
        <p></p>
        <button type="submit">비밀번호 찾기</button>
        <p></p>
        <a href="{{route('users.login')}}">로그인으로 돌아가기</a>
        <a href="{{route('users.idsearch')}}">아이디 찾기</a>
        <a href="{{route('users.registration')}}">회원가입</a>
    </form>
@endsection