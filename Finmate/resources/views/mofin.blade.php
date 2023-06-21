@extends('layout.layout')

@section('title', 'mofin')

@section('contents')



{{-- 
<h1> 캐릭터 관리</h1>
                <div >
                @if ($data->moffintype == 1)
                    <img src="{{ asset('/img/rabbit.png') }}" alt=""  style="width : 300px; height :200 px; position:absolute; right:50px; bottom:380px;  ">
                @elseif ($data->moffintype == 2)
                    <img src="{{ asset('/img/penguin.png') }}" alt="" id="mofin" style="width : 300px; height :200 px; position:absolute; right:50px; bottom:380px;" >
                @elseif ($data->moffintype == 3)
                    <img src="{{ asset('/img/panda.png') }}" alt="" style="width : 300px; height :200 px; position:absolute; right:50px; bottom:380px;  " >
                @endif
                
                </div>
                <h1> {{ $data->username }} 님의 {{ $data->moffinname }}</h1>
<h2>나의 포인트 : {{$data->point}}</h2> <br><br>
<h2>나의 아이템 목록</h2> <br><br>
 <h3>{{$itemname}}</h3> --}}
    <div>
        @foreach($itemname as $value)
        <p>{{$value->moffintype}}</p>



            @if($value === '선글라스')
                <img src="{{ asset('/img/sunglasses.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button  onclick="toggleitem1()" >장착/해제</button>
            @elseif($value === '검')
                <img src="{{ asset('/img/sword.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button  onclick="toggleitem2()" >장착/해제</button>
            @elseif($value === '안전모')
                <img src="{{ asset('/img/safe.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button  onclick="toggleitem3()" >장착/해제</button>
            @elseif($value === '에어팟맥스')
                <img src="{{ asset('/img/air.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button  onclick="toggleitem4()" >장착/해제</button>
            @elseif($value === '사원증')
                <img src="{{ asset('/img/idcard.png') }}" alt="" style="width : 200px; height :200 px;"> {{$value}} <button  onclick="toggleitem5()" >장착/해제</button>
            @endif    
        @endforeach
    </div>  
<br><br>
    <div  >
                <div>
                <img id="charitem1" src="{{ asset('/img/sunglasses.png') }}" alt="" style="width : 300px; height :200 px; display:none; position:absolute; right:50px; bottom:380px;">
                <img id="charitem2" src="{{ asset('/img/sword.png') }}" alt="" style="width : 300px; height :200 px; display:none; position:absolute; right:50px; bottom:380px;  "  >
                <img id="charitem3" src="{{ asset('/img/safe.png') }}" alt="" style="width : 300px; height :200 px; display:none; position:absolute; right:50px; bottom:380px;  "  >
                <img id="charitem4" src="{{ asset('/img/air.png') }}" alt="" style="width : 300px; height :200 px; display:none; position:absolute; right:50px; bottom:380px;  "  >
                <img id="charitem5" src="{{ asset('/img/idcard.png') }}" alt="" style="width : 300px; height :200 px; display:none; position:absolute; right:50px; bottom:380px;  "  >
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

    @if (isset($pt1))
        <script>
            // 페이지가 로드될 때 자동으로 실행되도록 수정
            window.addEventListener('load', function() {
                alert(' {{ $pt1 }} !!' );
                toggleitem1();
            });
        </script>
    @endif


@endsection