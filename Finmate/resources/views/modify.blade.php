@extends('layout.layout')

@section('title', 'Modify')

@section('header', 'WELCOME TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="modify" action="{{route('users.modify.post')}}" method="post">
        @csrf
        <div class="regist">
            <div class="label3">
                <label for="name">이름</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="label3">
                <label for="id">아이디</label>
                <input type="text" name="id" id="id" value="{{ old('id') }}" required>
            </div>
            <div class="label3">
                <label for="password">비밀번호</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="label3">
                <label for="passwordchk">비밀번호 확인</label>
                <input type="password" name="passwordchk" id="passwordchk" required>
            </div>
            <div class="label3">
                <label for="email">이메일</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                {{-- <button type="button" class="button" id="btn" onclick="btnclick();">인증하기</button> --}}
            </div>
            <div class="label3">
                <label for="phone">휴대폰</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required>
            </div>
            <div class="btn">
                <button type="submit" class="button" id="button">변경하기</button>
            </div>
            <div class="btn2">
            <button type="submit" class="button" id="button">회원탈퇴</button>
            </div>
        </div>
    </form>

<script src="{{ asset('/js/user.js') }}"></script>
@endsection