@extends('layout.layout')

@section('title', 'Login')

@section('header', 'LOGIN TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div class=success>{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <form id="table" action="{{route('users.login.post')}}" method="post">
        @csrf
        <div class="label">
            <label for="id">아이디</label>
            <input type="text" name="id" id="id" value="{{ old('id') }}" autocomplete="off" required>
        </div>
        <div class="label">
            <label for="password">비밀번호</label>
            <input type="password" name="password" id="password" required>
        </div>
            <button type="submit" class="button" id="button">로그인</button>
        <div class="bottom">
            <a href="{{route('users.findid')}}" id="down">아이디 찾기</a>
            <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
            <a href="{{route('users.registration')}}" id="down">회원가입</a>
        </div>
        {{-- <a href="javascript:kakaoLogin();"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR14h3LQGAX4fTgXPCZdfghlOB3AgQkodSA7-Cx83nXzAXJrsN9tWGybsMmu0vm-oHSHQ&usqp=CAU" alt=""></a>
        <script src="https://developers.kakao.com./sdk/js/kakao.js"></script>
        <script>
            //js key
        	//4699cc71bdf057335511bc15da234da1
            window.Kakao.init("4699cc71bdf057335511bc15da234da1");

            function kakaoLogin(){
                window.Kakao.Auth.login({
                    scope:'profile_nickname, account_email, gender',
                    success: function(authObj){
                        console.log(authObj);
                        window.Kakao.API.request({
                            url:'/v2/user/me',
                            success: res => {
                                const kakao_account = res.kakao_account;
                                console.log(kakao_account);
                            }
                        })
                    }
                });

            }
                
        </script> --}}
    </form>
@endsection