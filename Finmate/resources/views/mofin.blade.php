@extends('layout.layout')

@section('title', 'mofin')

@section('header', 'DRAWING')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/hj.css') }}">
<h1>캐릭터 관리</h1>
<br>
<h2>나의 포인트: {{$data->point}}</h2><br><br><br>

<div class="random">
    <div class="randombox">
        <form action="{{route('mofin.point',[auth()->user()->userid])}}" method="post">
            @csrf
            <button type="submit" class="randombtn">
                <img class="randomimg" src="{{ asset('/img/randitem.png') }}">
            </button>
        </form>
        <span class="bold">랜덤 포인트 뽑기</span>
        <span>(100pt)</span>
    </div>

    <div class="randombox">
        <form action="{{route('mofin.item',[auth()->user()->userid])}}" method="post">
            @csrf
            <button type="submit" class="randombtn">
                <img class="randomimg" src="{{ asset('/img/randpoint.png') }}">
            </button>
        </form>
        <span class="bold">랜덤 아이템 뽑기</span>
        <span>(500pt)</span>
    </div>
</div>
<br><br>
<h2>내 컬렉션</h2>

<div class="item-list">
    @foreach ($itemname as $value)
        <div class="item-box">
            @if ($value === '선글라스')
                <img class="item-img" src="{{ asset('/img/sunglasses.png') }}">
            @elseif ($value === '검')
                <img class="item-img" src="{{ asset('/img/sword.png') }}">
            @elseif ($value === '안전모')
                <img class="item-img" src="{{ asset('/img/safe.png') }}">
            @elseif ($value === '에어팟맥스')
                <img class="item-img" src="{{ asset('/img/air.png') }}">
            @elseif ($value === '사원증')
                <img class="item-img" src="{{ asset('/img/idcard.png') }}">
            @elseif($value === '날개')
                <img class="item-img" src="{{ asset('/img/wing.png') }}">
            @elseif($value === '티셔츠')
                <img class="item-img" src="{{ asset('/img/tea.png') }}">
            @elseif($value === '야구배트')
                <img class="item-img" src="{{ asset('/img/bat.png') }}">
            @elseif($value === '아잉눈')
                <img class="item-img" src="{{ asset('/img/eyeing.png') }}">
            @elseif($value === '노트북')
                <img class="item-img" src="{{ asset('/img/notebook.png') }}">
            @elseif($value === '여성한복')
                <img class="item-img" src="{{ asset('/img/hanbok.png') }}">
            @elseif($value === '남성한복')
                <img class="item-img" src="{{ asset('/img/hanbokbaji.png') }}">
            @elseif($value === '유아복')
                <img class="item-img" src="{{ asset('/img/kindcloth.png') }}">
            @endif
            <span class="item-name">{{ $value }}</span>
        </div>
    @endforeach
</div>

@if (session()->has('pt1'))
    <script>
        // 페이지가 로드될 때 자동으로 실행되도록 수정
        window.addEventListener('load', function() {
            alert('{{ session('pt1') }}');
        });
    </script>
@endif

@endsection