@extends('layout.layout')

@section('title', 'Registration')

@section('header', 'SIGN UP TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="form" action="{{route('users.registration.post')}}" method="post">
        @csrf
        <div class="regist">
            <div class="label2">
                <label for="name">이름</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="off" required>
            </div>
            <div class="label2">
                <label for="id">아이디</label>
                <input type="text" name="id" id="id" value="{{ old('id') }}" autocomplete="off" required>
                <button type="button" class="button" id="btn" onclick="checkDuplicateButton();">중복확인</button>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="password">비밀번호</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="label2">
                <label for="passwordchk">비밀번호 확인</label>
                <input type="password" name="passwordchk" id="passwordchk" required>
            </div>
            <div class="label2">
                <label for="email">이메일</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="off" required>
                {{-- <button type="button" class="button" id="btn" onclick="btnclick();">인증하기</button> --}}
            </div>
            <div class="label2">
                <label for="phone">휴대폰</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" autocomplete="off" required>
            </div>
            <div id="menu">
                <label for="moffintype">나의 모핀이 선택</label>
                <div>
                    <span id="chara">
                        <img src="{{ asset('/img/rabbit2.png') }}" alt="rabbit">
                    </span>
                    <p class="arrow_box">저를 데려가주세요!</p>
                    <input type="radio" name="moffintype" value="1">
                </div>
                <div>
                    <span id="chara">
                        <img src="{{ asset('/img/penguin2.png') }}" alt="penguin">
                    </span>
                    <p class="arrow_box">날 데려가면 좋을걸?</p>
                    <input type="radio" name="moffintype" value="2">
                </div>
                <div>
                    <span id="chara">
                        <img src="{{ asset('/img/panda2.png') }}" alt="panda">
                    </span>
                    <p class="arrow_box">날 데려가라!</p>
                    <input type="radio" name="moffintype" value="3">
                </div>
            </div>
            <div class="btn">
                <button type="submit" class="button" id="button">가입하기</button>
            </div>
        </div>
    </form>

<script src="{{ asset('/js/user.js') }}"></script>
@endsection