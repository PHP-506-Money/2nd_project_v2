@extends('layout.layout')

@section('title', 'mofin')

@section('contents')


<h1>나의 모핀이</h1>
<h2>나의 포인트 : {{$data->point}}</h2> <br>
<h2>나의 아이템 목록</h2> <br>
{{-- <h3>{{$itemname}}</h3> --}}
    <div>
        @foreach($itemname as $value)
            @if($value === '선글라스')
                <img src="{{ asset('/img/sunglasses.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button onclick="toggleitem1()" >장착</button>
            @elseif($value === '검')
                <img src="{{ asset('/img/sword.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button>장착</button>
            @elseif($value === '안전모')
                <img src="{{ asset('/img/safe.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button>장착</button>
            @elseif($value === '에어팟맥스')
                <img src="{{ asset('/img/air.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button>장착</button>
            @elseif($value === '사원증')
                <img src="{{ asset('/img/idcard.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button>장착</button>
            @endif    
        @endforeach
    </div>
<br><br>
    <div  >
                <div >
                @if ($data->moffintype == 1)
                    <img src="{{ asset('/img/rabbit.jpg') }}" alt=""  style="width : 300px; height :200 px;">
                @elseif ($data->moffintype == 2)
                    <img src="{{ asset('/img/penguin.jpg') }}" alt="" id="mofin" style="width : 300px; height :200 px;" >
                @elseif ($data->moffintype == 3)
                    <img src="{{ asset('/img/panda.jpg') }}" alt="" style="width : 300px; height :200 px;" >
                @endif
                
                    {{ $data->username }} 님의 {{ $data->moffinname }}
                </div>
                <div>
                <img  style= "display:none;" id="charitem1" src="{{ asset('/img/sunglasses.png') }}" alt="" style="width : 300px; height :200 px;">
                <img src="{{ asset('/img/sword.png') }}" alt="" style="width : 300px; height :200 px;" id="charitem2" >
                <img src="{{ asset('/img/safe.png') }}" alt="" style="width : 300px; height :200 px;" id="charitem3" >
                <img src="{{ asset('/img/air.png') }}" alt="" style="width : 300px; height :200 px;" id="charitem4" >
                <img src="{{ asset('/img/idcard.png') }}" alt="" style="width : 300px; height :200 px;" id="charitem5" >
                </div>
                {{-- <button onclick="toggleitem()">선글라스 장착</button> --}}
    </div>

    <div>

        <div style = "float:left;">
        <form action="{{route('mofin.point',[auth()->user()->userno])}}" method="post" >
            @csrf
        <button onclick="pt()" type="submit"><img src="{{ asset('/img/random.png') }}" alt="" style="width : 200px; height :200 px;" ></button>
        </form>
        <span>랜덤 포인트</span>
        </div>

        <div style = "display:inline-block; ">
        <form action="{{route('mofin.item',[auth()->user()->userno])}}" method="post" style="display : inline-block;">
            @csrf
        <button onclick="pt()" type="submit"><img src="{{ asset('/img/randomitem.png') }}" alt="" style="width : 200px; height :200 px;" ></button>
        </form>
        <span>랜덤 아이템</span>
        </div>
<button onclick="toggleitem1()" >장착</button>
    </div>
    @if(isset($pt1))
        <script>
            // 페이지가 로드될 때 자동으로 실행되도록 수정
            window.addEventListener('DOMContentLoaded', function() {
                alert(' {{ $pt1 }} !!' );
            });
        </script>
        <script>
        toggleitem1(){
            var charitem1 = document.getElementById('charitem1');
                    if (charitem1.style.display == 'none') {
            charitem1.style.display = 'block'
            } 
            //else {
            //    charitem1.style.display = 'none';
            //}
        }
        </script>
    @endif


@endsection