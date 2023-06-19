@extends('layout.layout')

@section('title', 'Registration')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="form" action="{{route('users.registration.post')}}" method="post">
        @csrf
        <br>
        <div class="regist">
            <div class="label2">
                <label for="name">이름</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
            </div>
            <div class="label2">
                <label for="id">아이디</label>
                <input type="text" name="id" id="id" value="{{ old('id') }}">
                <button type="button" class="button" id="btn" onclick="checkDuplicateButton();">중복확인</button>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="password">비밀번호</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="label2">
                <label for="passwordchk">비밀번호 확인</label>
                <input type="password" name="passwordchk" id="passwordchk">
            </div>
            <div class="label2">
                <label for="email">이메일</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <button type="button" class="button" id="btn" onclick="btn();">인증하기</button>
            </div>
            <div class="label2">
                <label for="phone">휴대폰</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}">
            </div>
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
            <div class="btn">
                <button type="submit" class="button">가입하기</button>
            </div>
        </div>
    </form>

<script src="{{ asset('/js/user.js') }}"></script>
@endsection