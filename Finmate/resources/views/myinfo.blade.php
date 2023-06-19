@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'WELCOME TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div id="table">
        <img src="{{ asset('/img/rabbit.png') }}" alt="">
        <div>
        @foreach ($data as $user)
            @if ($user->moffinname == 1)
                <img src="{{ asset('/img/rabbit.png') }}" alt="">
            @elseif ($user->moffinname == 2)
                <img src="{{ asset('/img/panda.png') }}" alt="">
            @elseif ($user->moffinname == 3)
                <img src="{{ asset('/img/penguin.png') }}" alt="">
            @endif
            {{ $user->username }}님의 {{ $user->moffinname }}
        @endforeach
        </div>
        <div>
            <button type="button" class="button" id="btn">모핀이명 변경</button>
            <button type="button" class="button" id="btn">공유하기</button>
        </div>
        <div class="bottom">
            <a href="{{route('users.modify')}}" id="down">회원정보 수정</a>
        </div>
    </div>
@endsection