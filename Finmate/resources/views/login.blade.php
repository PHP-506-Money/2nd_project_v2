@extends('layout.layout')

@section('title', 'Login')

@section('contents')
    <h1>LOGIN</h1>
    <p></p>
    @include('layout.errorsvalidate')
    <div>{!!session()->has('success') ? session('success') : ""!!}</div>
    <form action="{{route('users.login.post')}}" method="post">
        @csrf
        <label for="id">아이디</label>
        <input type="text" name="id" id="id">
        <p></p>
        <label for="password">비밀번호</label>
        <input type="password" name="password" id="password">
        <p></p>
        <button type="submit">로그인</button>
        <p></p>
        <a href="{{route('users.findid')}}">아이디 찾기</a>
        <a href="{{route('users.findpw')}}">비밀번호 찾기</a>
        <a href="{{route('users.registration')}}">회원가입</a>
    </form>
@endsection