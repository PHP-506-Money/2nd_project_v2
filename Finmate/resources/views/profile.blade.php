@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MYINFO TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/hj.css')  }}" >
    <div>{!!session()->has('success') ? session('success') : ""!!}</div>



    @include('layout.errorsvalidate')
    <div class ="container">
        <div>{{-- 모핀프로필 --}}
        <form id="myinfo" name="myinfo" action="{{route('users.profile.post')}}" method="post">
            @csrf
                <div>
                                    <img id="charitem1" class="noneimg" src="{{ asset('/img/sunglasses.png') }}" alt="">
                                    <img id="charitem2" class="noneimg" src="{{ asset('/img/sword.png') }}" alt="" >
                                    <img id="charitem3" class="noneimg" src="{{ asset('/img/safe.png') }}" alt="" >
                                    <img id="charitem4" class="noneimg" src="{{ asset('/img/air.png') }}" alt=""   >
                                    <img id="charitem5" class="noneimg" src="{{ asset('/img/idcard.png') }}" alt="" >
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
                    {{ $user->username }} 님의 <textarea name="moffinname" id="moffinname" cols="10" rows="1" required>{{ $user->moffinname }}</textarea>
                    @endforeach
                </div>
                <div class="bottom2">
                    <button type="button" class="button" id="btn" onclick="moffinnameChan();" autocomplete="off" required>모핀이명 변경</button>
                    <button type="button" class="button" id="btn" onclick="btnClick();">공유하기</button>
                </div>
        </form><br><br>
        </div>{{-- 모핀 프로필 종료 --}}

    </div>
        <h3> 내 아이템 목록(클릭시 장착/해제)</h3>
        <div class="itemlist"> {{-- 아이템 부분 --}}
                    @foreach($itemname as $value)
                        @if($value === '선글라스')
                            <button class="itembtn"  onclick="toggleitem1()" > <img src="{{ asset('/img/sunglasses.png') }}" class = "itemimg">  </button>
                        @elseif($value === '검')
                            <button class="itembtn"   onclick="toggleitem2()" > <img src="{{ asset('/img/sword.png') }}" class = "itemimg">  </button>
                        @elseif($value === '안전모')
                            <button class="itembtn"   onclick="toggleitem3()" > <img src="{{ asset('/img/safe.png') }}"  class = "itemimg"> </button>
                        @elseif($value === '에어팟맥스')
                            <button class="itembtn"   onclick="toggleitem4()" > <img src="{{ asset('/img/air.png') }}"  class = "itemimg">  </button>
                        @elseif($value === '사원증')
                            <button class="itembtn"   onclick="toggleitem5()" > <img src="{{ asset('/img/idcard.png') }}"  class = "itemimg"> </button>
                        @endif    
                    @endforeach
        
        </div>

@endsection

<script src="{{ asset('/js/user.js') }}"></script>