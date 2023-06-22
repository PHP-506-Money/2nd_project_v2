@extends('layout.layout')

@section('title', 'CHANGE PASSWORD')

@section('header', 'CHANGE PASSWORD')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="table" action="{{route('users.foundpw.post')}}" method="post">
        @csrf
            @if ($user)
                <div class="label5">
                    <label for="password">변경할 비밀번호</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="label5">
                    <label for="passwordchk">비밀번호 확인</label>
                    <input type="password" name="passwordchk" id="passwordchk" required>
                </div>
                <div class="btn">
                    <button type="submit" class="button" id="button3">비밀번호 변경</button>
                </div>
                <div class="bottom">
                    <a href="{{route('users.login')}}" id="down">로그인으로 돌아가기</a>
                    <a href="{{route('main')}}" id="down">메인으로 돌아가기</a>
                </div>
            @else
                <div class="label4">
                    <label>비밀번호를 찾을 수 없습니다.</label>
                </div>
                <button type="button" class="button" id="button" onclick="location.href='/users/findpw';">돌아가기</button>
                <div class="bottom">
                    <a href="{{route('users.findid')}}" id="down">아이디 찾기</a>
                    <a href="{{route('users.registration')}}" id="down">회원가입</a>
                    <a href="{{route('users.login')}}" id="down">로그인</a>
                </div>
            @endif
    </form>
@endsection