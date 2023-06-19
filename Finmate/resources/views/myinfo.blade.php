@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'WELCOME TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="table" action="{{route('users.myinfo.post')}}" method="post">
        @csrf
        <div>
            @foreach ($data as $user)
                @if ($user->moffintype == 1)
                    <img src="{{ asset('/img/rabbit.png') }}" alt="">
                @elseif ($user->moffintype == 2)
                    <img src="{{ asset('/img/penguin.png') }}" alt="">
                @elseif ($user->moffintype == 3)
                    <img src="{{ asset('/img/panda.png') }}" alt="">
                @endif
                <div>
                {{ $user->username }}님의 <input type="text" name="moffinname" id="moffinname" value="{{ $user->moffinname }}">
                </div>
            @endforeach
        </div>
        <div>
            <button type="submit" class="button" id="btn">모핀이명 변경</button>
            <button type="button" class="button" id="btn">공유하기</button>
        </div>
        <div class="bottom">
            <a href="{{route('users.modify')}}" id="down">회원정보 수정</a>
        </div>
    </form>
@endsection