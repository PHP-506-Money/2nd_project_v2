@extends('layout.layout')

@section('title', 'rank')

@section('header', 'Rank')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/hj.css') }}">

<div class="bigbox">

    @php
    $rank = 1 ; 
    @endphp
    <div class="pointrank_list">
    <h2>포인트부자</h2>
        @foreach($pointrank as $value)
            {{$rank}}
            {{'닉네임 : '.$value->username}}
            <pre>{{' 포인트 : '.$value->point}}</pre>
            
            <br>
            @php
                $rank++;
            @endphp
        @endforeach
    </div>


    @php
    $login = 1 ; 
    @endphp
    <div class="loginrank_list">
    <h2>로그인왕</h2>
        @foreach($loginrank as $value)
            {{$login}}
            {{'닉네임 : '.$value->username}}
            <pre>{{' 로그인횟수 : '.$value->login_count}}</pre>
            
            <br>
            @php
                $login++;
            @endphp
        @endforeach
    </div>


    @php
    $item = 1 ; 
    @endphp
    <div class="itemrank_list">
    <h2>아이템뽑기왕</h2>
        @foreach($itemdrawrank as $value)
            {{$item}}
            {{'닉네임 : '.$value->username}}
            <pre>{{' 아이템뽑기 횟수 : '.$value->item_draw_count}}</pre>
            
            <br>
            @php
                $item++;
            @endphp
        @endforeach
    </div>


</div>

@endsection