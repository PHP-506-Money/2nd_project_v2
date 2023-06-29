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
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="한글, 영문 2~20자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영문 2~20자 사이로 입력해주세요.'" autocomplete="off" required>
                <div id="errMsgId"></div>
                <div id="errMsg"></div>
            </div>
            <div class="label2">
                <label for="id">아이디</label>
                <input type="text" name="id" id="id" value="{{ old('id') }}" placeholder="영문, 숫자 4~12자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자 4~12자 사이로 입력해주세요.'" autocomplete="off" required>
                <button type="button" class="button" id="btn" onclick="checkDuplicateButton();">중복확인</button>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="password">비밀번호</label>
                <input type="password" name="password" id="password" placeholder="영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력'" required>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="passwordchk">비밀번호 확인</label>
                <input type="password" name="passwordchk" id="passwordchk" placeholder="비밀번호란과 동일하게 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '비밀번호란과 동일하게 입력해주세요.'" required>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="email">이메일</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="이메일주소를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '이메일주소를 입력해주세요.'" autocomplete="off" required>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="phone">휴대폰</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="휴대폰번호를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '휴대폰번호를 입력해주세요.'" autocomplete="off" required>
                <div id="errMsgId"></div>
            </div>
            <div id="menu">
                <label for="moffintype">나의 모핀이 선택</label>
                <div>
                    <label for="rabbit">
                        <span id="chara">
                            <img src="{{ asset('/img/rabbit2.png') }}" alt="rabbit">
                        </span>
                        <p class="arrow_box">저를 데려가주세요!</p>
                        <input type="radio" name="moffintype" id="rabbit" value="1">
                    </label>
                </div>
                <div>
                    <label for="penguin">
                        <span id="chara">
                            <img src="{{ asset('/img/penguin2.png') }}" alt="penguin">
                        </span>
                        <p class="arrow_box">날 데려가면 좋을걸?</p>
                        <input type="radio" name="moffintype" id="penguin" value="2">
                    </label>
                </div>
                <div>
                    <label for="panda">
                        <span id="chara">
                            <img src="{{ asset('/img/panda2.png') }}" alt="panda">
                        </span>
                        <p class="arrow_box">날 데려가라!</p>
                        <input type="radio" name="moffintype" id="panda" value="3">
                    </label>
                </div>
            </div>
            <div class="btn">
                <button type="submit" class="button" id="button">가입하기</button>
            </div>
        </div>
    </form>

<script src="{{ asset('/js/user.js') }}"></script>
@endsection