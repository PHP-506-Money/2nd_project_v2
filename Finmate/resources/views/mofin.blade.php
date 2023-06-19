@extends('layout.layout')

@section('title', 'mofin')

@section('contents')



<h1>나의 모핀이</h1>
<h2>나의 포인트 : {{$data->point}}</h2> <br>
<h2>나의 아이템 목록</h2> <br>
<h3>{{$itemname}}</h3>
<br><br>

<form action="{{route('mofin.point',[auth()->user()->userno])}}" method="post">
    @csrf
<button onclick="pt()" type="submit">랜덤포인트</button>
</form>
<br><br>

<form action="{{route('mofin.item',[auth()->user()->userno])}}" method="post">
    @csrf
<button onclick="pt()" type="submit">랜덤아이템</button>
</form>
@if(isset($pt1))
    <script>
        // 페이지가 로드될 때 자동으로 실행되도록 수정
        window.addEventListener('DOMContentLoaded', function() {
            alert(' {{ $pt1 }} !!' );
        });
    </script>

@endif


@endsection