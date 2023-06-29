@extends('layout.layout')

@section('title', 'WELCOME TO FINMATE')


@section('header', 'WELCOME TO FINMATE')


@section('contents')
<link rel="stylesheet" href="{{ asset('/css/main.css')  }}">
<div class="container">

    <div id="whole-wrapper">
        <div id="character-wrapper">

        </div>
        <div id="whoA">

        </div>
        <div id="chat-wrapper">
            <div id="name">
                모핀
            </div>
            <div id="text-wrapper">
                <div id="text">
                    텍스트 내용
                </div>

                <div id="next" onclick="parse(++cursor)">
                    &gt;
                </div>
            </div>
            <div id="setting">

                <span><a href="{{ url('/assets'.'/' . auth()->user()->userid) }}">내자산조회</a></span>
                <span><a href="{{ url('/users/profile'.'/' . auth()->user()->userid) }}">나의모핀이</a></span>

                <span><a href="{{url('/mofin'.'/' . auth()->user()->userid)}}">뽑기하러가기</a></span>

                <span><a href="{{ url('/main2') }}">Return</a></span>

            </div>
        </div>
        <div id="selector-wrapper">
            <ul id="selector">
                <li onclick="whoAreYou()">너는 누구야?</li>
                <li onclick="WhatAble()">핀메이트에선 뭘 할수있어?</li>
                <li onclick="randomRecomman()">뭐 먹을지 추천해줄래?</li>
            </ul>
        </div>
        <div id="selector-wrapper2">
            <ul id="selector2">
                <li onclick="selecRe()">응, 그래줄래?</li>
                <li onclick="parse(++cursor)">아니, 괜찮아</li>
            </ul>
        </div>
    </div>
</div>


<script>
    const username = "{{ auth()->user()->username }}";

</script>
<script src="{{ asset('/js/common.js') }}"></script>

@endsection

