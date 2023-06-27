@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MYINFO TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/hj.css')  }}" >
    <div>{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <div class ="container">
        <div class="profile">{{-- 모핀프로필 --}}
            <form id="profile2" name="profile2" method="post">
                @csrf
                <div class="charitem">
                    <img id="charitem1" class="noneimg" src="{{ asset('/img/sunglasses.png') }}" alt="">
                    <img id="charitem2" class="noneimg" src="{{ asset('/img/sword.png') }}" alt="" >
                    <img id="charitem3" class="noneimg" src="{{ asset('/img/safe.png') }}" alt="" >
                    <img id="charitem4" class="noneimg" src="{{ asset('/img/air.png') }}" alt=""   >
                    <img id="charitem5" class="noneimg" src="{{ asset('/img/idcard.png') }}" alt="" >
                </div>
                <div class="moffin">
                    @foreach ($data as $user)
                        @if ($user->moffintype == 0)
                            <img src="{{ asset('/img/moffin2.png') }}" alt="">
                        @elseif ($user->moffintype == 1)
                            <img src="{{ asset('/img/rabbit3.png') }}" alt="">
                        @elseif ($user->moffintype == 2)
                            <img src="{{ asset('/img/penguin3.png') }}" alt="">
                        @elseif ($user->moffintype == 3)
                            <img src="{{ asset('/img/panda3.png') }}" alt="">
                        @endif
                    @endforeach
                </div>
            </form>
        </div>{{-- 모핀 프로필 종료 --}}
    </div>
    <br><br>
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