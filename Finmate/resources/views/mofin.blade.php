@extends('layout.layout')

@section('title', 'mofin')

@section('contents')

<h1>나의 모핀이</h1>
<span>나의 포인트 : {{$data->point}}</span> <br>

<form action="{{route('mofin.point')}}" method="post">
    @csrf
<button onclick="pt()" type="submit">랜덤포인트</button>
</form>
<br><br>

<form action="{{route('mofin.item')}}" method="post">
    @csrf
<button type="submit">랜덤아이템</button>
</form>
@if(isset($pt1))
    <script>
        // 페이지가 로드될 때 자동으로 실행되도록 수정
        window.addEventListener('DOMContentLoaded', function() {
            alert('축하합니다 {{ $pt1 }} 당첨!!' );
        });
    </script>
@endif
@endsection