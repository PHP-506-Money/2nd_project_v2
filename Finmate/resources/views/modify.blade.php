@extends('layout.layout')

@section('title', 'Modify')

@section('header', 'WELCOME TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div class="success">{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <form id="modify" action="{{route('users.modify.post')}}" method="post">
        @csrf
        <div>
            @foreach ($data as $user)
                <div class="label3">
                    <label for="name">이름</label>
                    <input type="text" name="name" id="name" value="{{ $user->username }}" readonly>
                </div>
                <div class="label3">
                    <label for="id">아이디</label>
                    <input type="text" name="id" id="id" value="{{ $user->userid }}" readonly>
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
                    <input type="email" name="email" id="email" value="{{ $user->useremail }}"" required>
                    {{-- <button type="button" class="button" id="btn" onclick="btnclick();">인증하기</button> --}}
                </div>
                <div class="label3">
                    <label for="phone">휴대폰</label>
                    <input type="tel" name="phone" id="phone" value="{{ $user->phone }}" required>
                </div>
            @endforeach
            <div class="btn">
                <button type="submit" class="button" id="button">변경하기</button>
            </div>
            <div class="btn2">
                <div id="info">
                    {{-- {{ $user->username }} 님의 <input type="text" name="moffinname" id="moffinname" value="{{ $user->moffinname }}" required> --}}
                    {{ $user->username }} 님의 <textarea name="moffinname" id="moffinname" cols="10" rows="1" required>{{ $user->moffinname }}</textarea>
                    @endforeach
                </div>
                <button type="button" class="button" id="btn" onclick="moffinnameChan();" autocomplete="off" required>모핀이명 변경</button>
                <button type="button" class="button" id="button2" onclick="confirmWithdrawal()">회원탈퇴</button>
            </div>
        </div>
    </form>

<script src="{{ asset('/js/user.js') }}"></script>
@endsection