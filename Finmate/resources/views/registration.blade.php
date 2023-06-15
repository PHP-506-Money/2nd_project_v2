@extends('layout.layout')

@section('title', 'Registration')

@section('contents')
    <h1>REGISTRATION</h1>
    <p></p>
    @include('layout.errorsvalidate')
    <form action="{{route('users.registration.post')}}" method="post">
        @csrf
        <label for="name">이름</label>
        <input type="text" name="name" id="name">
        <p></p>
        <label for="id">아이디</label>
        <input type="text" name="id" id="id">
        <button type="button">중복확인</button>
        <p></p>
        <label for="password">비밀번호</label>
        <input type="password" name="password" id="password">
        <p></p>
        <label for="passwordchk">비밀번호 확인</label>
        <input type="password" name="passwordchk" id="passwordchk">
        <p></p>
        <label for="email">이메일</label>
        <input type="email" name="email" id="email">
        <button type="button">인증하기</button>
        <p></p>
        <label for="phone">휴대폰</label>
        <input type="tel" name="phone" id="phone">
        <p></p>
        <label for="character">나의 모핀이 선택</label>
            <div>
                <div>
                    <img src="{{ asset('/img/rabbit.png') }}" alt="rabbit">
                    <input type="radio" name="character" value="1">        
                </div>
                <div>
                    <img src="{{ asset('/img/penguin.png') }}" alt="penguin">
                    <input type="radio" name="character" value="2">        
                </div>
                <div>
                    <img src="{{ asset('/img/panda.png') }}" alt="panda">
                    <input type="radio" name="character" value="3">        
                </div>
            </div>
        <p></p>
        <button type="submit">가입하기</button>
    </form>
@endsection