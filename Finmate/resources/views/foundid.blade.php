@extends('layout.layout')

@section('title', 'FindID')

@section('header', 'FIND ID')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="table">
        @csrf
            @if ($user)
                <div class="label4">
                    <label for="id">{{ $user->username }} 님의 아이디는 </label><br>
                    <input type="text" name="id" id="id" value="{{ $user->userid }}">
                    <label>입니다.</label>
                </div>
                <button type="button" class="button" id="button3" onclick="location.href='/users/login';">로그인</button>
                <div class="bottom">
                    <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
                    <a href="{{route('users.registration')}}" id="down">회원가입</a>
                </div>
            @else
                <div class="label4">
                    <label>일치하는 사용자가 없습니다.</label>
                </div>
                <button type="button" class="button" id="button" onclick="location.href='/users/findid';">돌아가기</button>
                <div class="bottom">
                    <a href="{{route('users.login')}}" id="down">로그인</a>
                    <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
                    <a href="{{route('users.registration')}}" id="down">회원가입</a>
                </div>
            @endif
    </form>
@endsection