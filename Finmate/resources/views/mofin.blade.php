@extends('layout.layout')

@section('title', 'mofin')

@section('header', 'MY MOFIN')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/hj.css')  }}" >



    <h1> 캐릭터 관리</h1>
    <br>
    <h2>나의 포인트 : {{$data->point}}</h2>
<div class="container">
    <div class="box1">
            <div class="item">
                <h2 class = "text_1" >나의 아이템 목록</h2> <br><br>
                <h3 class = "text_1" >@foreach($itemname as $value)    
                    {{$value}}
                    @endforeach
                </h3>
                @foreach($itemname as $value)
                    @if($value === '선글라스')
                        <img src="{{ asset('/img/sunglasses.png') }}" class = "itemimg"> {{$value}} <button  onclick="toggleitem1()" >장착/해제</button>
                    @elseif($value === '검')
                        <img src="{{ asset('/img/sword.png') }}" class = "itemimg"> {{$value}} <button  onclick="toggleitem2()" >장착/해제</button>
                    @elseif($value === '안전모')
                        <img src="{{ asset('/img/safe.png') }}"  class = "itemimg"> {{$value}} <button  onclick="toggleitem3()" >장착/해제</button>
                    @elseif($value === '에어팟맥스')
                        <img src="{{ asset('/img/air.png') }}"  class = "itemimg"> {{$value}} <button  onclick="toggleitem4()" >장착/해제</button>
                    @elseif($value === '사원증')
                        <img src="{{ asset('/img/idcard.png') }}"  class = "itemimg"> {{$value}} <button  onclick="toggleitem5()" >장착/해제</button>
                    @endif    
                @endforeach
            </div>
            <br><br><br>
        <div class="random">
                <div class="randombox" >
                    <form action="{{route('mofin.point',[auth()->user()->userid])}}" method="post" >
                        @csrf
                        <button type="submit"><img class="randomimg" src="{{ asset('/img/random.png') }}" ></button>
                    </form>
                    <span>랜덤 포인트(100pt)</span>
                </div>

                <div class="randombox" >
                    <form action="{{route('mofin.item',[auth()->user()->userid])}}" method="post">
                        @csrf
                        <button type="submit"><img class="randomimg" src="{{ asset('/img/randomitem.png') }}"  ></button>
                    </form>
                    <span>랜덤 아이템(500pt)</span>
                </div>
        </div>
    </div>{{-- end box1--}}

    <div class="char">
        @if ($data->moffintype == 1)
            <img src="{{ asset('/img/rabbit.png') }}" class="charimg">
        @elseif ($data->moffintype == 2)
            <img src="{{ asset('/img/penguin.png') }}" class="charimg">
        @elseif ($data->moffintype == 3)
            <img src="{{ asset('/img/panda.png') }}"  class="charimg">
        @endif
        <h2 class = "text_1" > {{ $data->username }} 님의 {{ $data->moffinname }}</h2>
    </div>
        

</div>{{-- end container  --}}
    <div>
                <div>
                <img id="charitem1" class="noneimg" src="{{ asset('/img/sunglasses.png') }}" alt="">
                <img id="charitem2" class="noneimg" src="{{ asset('/img/sword.png') }}" alt="" >
                <img id="charitem3" class="noneimg" src="{{ asset('/img/safe.png') }}" alt="" >
                <img id="charitem4" class="noneimg" src="{{ asset('/img/air.png') }}" alt=""   >
                <img id="charitem5" class="noneimg" src="{{ asset('/img/idcard.png') }}" alt="" >
                </div>
    </div>
    <script>
        function toggleitem1() {
            var charitem1 = document.getElementById('charitem1');
            if (charitem1.style.display === 'none') {
                charitem1.style.display = 'block';
            } else {
                charitem1.style.display = 'none';
            }
        }
            function toggleitem2() {
            var charitem2 = document.getElementById('charitem2');
            if (charitem2.style.display === 'none') {
                charitem2.style.display = 'block';
            } else {
                charitem2.style.display = 'none';
            }
        }
            function toggleitem3() {
            var charitem3 = document.getElementById('charitem3');
            if (charitem3.style.display === 'none') {
                charitem3.style.display = 'block';
            } else {
                charitem3.style.display = 'none';
            }
        }
            function toggleitem4() {
            var charitem4 = document.getElementById('charitem4');
            if (charitem4.style.display === 'none') {
                charitem4.style.display = 'block';
            } else {
                charitem4.style.display = 'none';
            }
        }
            function toggleitem5() {
            var charitem5 = document.getElementById('charitem5');
            if (charitem5.style.display === 'none') {
                charitem5.style.display = 'block';
            } else {
                charitem5.style.display = 'none';
            }
        }
    </script>
@if (session()->has('pt1'))
    <script>
        // 페이지가 로드될 때 자동으로 실행되도록 수정
        window.addEventListener('load', function() {
            alert('{{ session('pt1') }}');
            toggleitem1();
        });
    </script>
@endif



@endsection