@extends('layout.layout')

@section('title', 'Registration')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >

    @include('layout.errorsvalidate')
    <form action="{{route('users.registration.post')}}" method="post">
        @csrf
        <label for="name">이름</label>
        <input type="text" name="name" id="name">
        <p></p>
        <label for="id">아이디</label>
        <input type="text" name="id" id="id">
        <button type="button" class="button" id="checkDuplicate" onclick="checkDuplicateButton();">중복확인</button>
        <div id="errMsgId"></div>
        <p></p>
        <label for="password">비밀번호</label>
        <input type="password" name="password" id="password">
        <p></p>
        <label for="passwordchk">비밀번호 확인</label>
        <input type="password" name="passwordchk" id="passwordchk">
        <p></p>
        <label for="email">이메일</label>
        <input type="email" name="email" id="email">
        <button type="button" class="button" onclick="btn();">인증하기</button>
        <p></p>
        <label for="phone">휴대폰</label>
        <input type="tel" name="phone" id="phone">
        <p></p>
            <div id="menu">
                <label for="moffintype">나의 모핀이 선택</label>
                <div>
                    <span id="chara">
                        <img src="{{ asset('/img/rabbit.png') }}" alt="rabbit">
                    </span>
                    <p class="arrow_box">저를 데려가주세요!</p>
                    <input type="radio" name="moffintype" value="1">
                </div>
                <div>
                    <span id="chara">
                        <img src="{{ asset('/img/penguin.png') }}" alt="penguin">
                    </span>
                    <p class="arrow_box">날 데려가면 좋을걸?</p>
                    <input type="radio" name="moffintype" value="2">
                </div>
                <div>
                    <span id="chara">
                        <img src="{{ asset('/img/panda.png') }}" alt="panda">
                    </span>
                    <p class="arrow_box">날 데려가라!</p>
                    <input type="radio" name="moffintype" value="3">
                </div>
            </div>
        <p></p>
        <button type="submit" class="button">가입하기</button>
    </form>

<script src="{{ asset('/js/user.js') }}"></script>
@endsection