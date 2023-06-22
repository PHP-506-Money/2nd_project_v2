@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MYINFO TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    @include('layout.errorsvalidate')
    <form id="myinfo" name="myinfo" action="{{route('users.myinfo.post')}}" method="post">
        @csrf
        <div>
            @foreach ($data as $user)
                @if ($user->moffintype == 0)
                    <img src="{{ asset('/img/moffin2.png') }}" alt="">
                @elseif ($user->moffintype == 1)
                    <img src="{{ asset('/img/rabbit.png') }}" alt="">
                @elseif ($user->moffintype == 2)
                    <img src="{{ asset('/img/penguin.png') }}" alt="">
                @elseif ($user->moffintype == 3)
                    <img src="{{ asset('/img/panda.png') }}" alt="">
                @endif
        </div>
        <div id="info">
            {{-- {{ $user->username }} 님의 <input type="text" name="moffinname" id="moffinname" value="{{ $user->moffinname }}" required> --}}
            {{ $user->username }} 님의 <textarea name="moffinname" id="moffinname" cols="10" rows="1">{{ $user->moffinname }}</textarea>
            @endforeach
        </div>
        <div class="bottom2">
            <button type="button" class="button" id="btn" onclick="moffinnameChan();" autocomplete="off" required>모핀이명 변경</button>
            <button type="button" class="button" id="btn" onclick="btnClick();">공유하기</button>
        </div>
    </form>
@endsection

<script src="{{ asset('/js/user.js') }}"></script>