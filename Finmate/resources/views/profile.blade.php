@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MY MOFIN')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/hj.css')  }}" >
    <div class="success">{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <div class="profile">{{-- 모핀 프로필 시작 --}}
        <form id="myinfo" name="myinfo" action="{{route('users.profile.post')}}" method="post">
            @csrf
                <div class="charitem">
                    <img id="charitem1" class="noneimg" src="{{ asset('/img/sunglasses.png') }}" style ="z-index : 50 ;">
                    <img id="charitem2" class="noneimg" src="{{ asset('/img/sword.png') }}" >
                    <img id="charitem3" class="noneimg" src="{{ asset('/img/safe.png') }}" >
                    <img id="charitem4" class="noneimg" src="{{ asset('/img/air.png') }}"   >
                    <img id="charitem5" class="noneimg" src="{{ asset('/img/idcard.png') }}" style ="z-index : 49 ;" >
                    <img id="charitem6" class="noneimg" src="{{ asset('/img/wing.png') }}" >
                    <img id="charitem7" class="noneimg" src="{{ asset('/img/tea.png') }}" >
                    <img id="charitem8" class="noneimg" src="{{ asset('/img/bat.png') }}" >
                    <img id="charitem9" class="noneimg" src="{{ asset('/img/eyeing.png') }}" >
                    <img id="charitem10" class="noneimg" src="{{ asset('/img/notebook.png') }}" >
                    <img id="charitem11" class="noneimg" src="{{ asset('/img/hanbok.png') }}" >
                    <img id="charitem12" class="noneimg" src="{{ asset('/img/hanbokbaji.png') }}" >
                    <img id="charitem13" class="noneimg" src="{{ asset('/img/kindcloth.png') }}" >
                </div>
                <div class="moffin">
                    @foreach ($data as $user)
                        @if ($user->moffintype == 0)
                            <img src="{{ asset('/img/moffin2.png') }}">
                        @elseif ($user->moffintype == 1)
                            <img src="{{ asset('/img/rabbit3.png') }}">
                        @elseif ($user->moffintype == 2)
                            <img src="{{ asset('/img/penguin3.png') }}">
                        @elseif ($user->moffintype == 3)
                            <img src="{{ asset('/img/panda3.png') }}" alt="">
                        @elseif ($user->moffintype == 4)
                            <img src="{{ asset('/img/moffin4.png') }}" alt="">
                        @elseif ($user->moffintype == 5)
                            <img src="{{ asset('/img/moffin5.png') }}" alt="">
                        @elseif ($user->moffintype == 6)
                            <img src="{{ asset('/img/moffin6.png') }}" alt="">
                        @endif
                    @endforeach
                </div>
                {{-- 다른 사용자의 프로필 조회 --}}
                @if ($userid !== $id)
                    <div id="info">
                        {{ $user->username }} 님의 {{ $user->moffinname }}
                    </div>
                    <div class="bottom3"></div>
        </form>
    </div>
        <div><input type="button" value="돌아가기" onclick="history_back()"></div>
                {{-- 현재 로그인한 사용자의 경우 --}}
                @else
                    <div id="info">
                        {{ $user->username }} 님의 <textarea name="moffinname" id="moffinname" cols="10" rows="1" placeholder="한글, 영어 1~6자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영어 1~6자 입력'" required>{{ $user->moffinname }}</textarea>
                    </div>
                    <div class="bottom2">
                        <button type="button" class="button" id="btn" onclick="moffinnameChan();">모핀이명 변경</button>
                        <button type="button" class="button" id="btn" onclick="btnClick();">공유하기</button>
                    </div>
        </form>
    </div>
                @endif
    {{-- 모핀 프로필 종료 --}}
    <div class="container">
        <div class="title">
            <h3> 내 아이템 목록(클릭시 장착/해제)</h3>
        </div>
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
                @elseif($value === '날개')
                    <button class="itembtn"   onclick="toggleitem6()" > <img src="{{ asset('/img/wing.png') }}"  class = "itemimg"> </button>
                @elseif($value === '티셔츠')
                    <button class="itembtn"   onclick="toggleitem7()" > <img src="{{ asset('/img/tea.png') }}"  class = "itemimg"> </button>
                @elseif($value === '야구배트')
                    <button class="itembtn"   onclick="toggleitem8()" > <img src="{{ asset('/img/bat.png') }}"  class = "itemimg"> </button>
                @elseif($value === '아잉눈')
                    <button class="itembtn"   onclick="toggleitem9()" > <img src="{{ asset('/img/eyeing.png') }}"  class = "itemimg"> </button>
                @elseif($value === '노트북')
                    <button class="itembtn"   onclick="toggleitem10()" > <img src="{{ asset('/img/notebook.png') }}"  class = "itemimg"> </button>
                @elseif($value === '여성한복')
                    <button class="itembtn"   onclick="toggleitem11()" > <img src="{{ asset('/img/hanbok.png') }}"  class = "itemimg"> </button>
                @elseif($value === '남성한복')
                    <button class="itembtn"   onclick="toggleitem12()" > <img src="{{ asset('/img/hanbokbaji.png') }}"  class = "itemimg"> </button>
                @elseif($value === '유아복')
                    <button class="itembtn"   onclick="toggleitem13()" > <img src="{{ asset('/img/kindcloth.png') }}"  class = "itemimg"> </button>
                @endif    
            @endforeach
        </div>
    </div>
{{-- @endif --}}
@endsection

<script src="{{ asset('/js/user.js') }}"></script>