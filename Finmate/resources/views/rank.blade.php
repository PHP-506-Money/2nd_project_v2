@extends('layout.layout')

@section('title', 'rank')

@section('header', 'Rank')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/hj.css') }}">

<h5>(닉네임클릭시 클릭한 회원의 모핀이를 구경할수있습니다!)</h5>
<br><br>
<div class="bigbox">

    <div class="pointrank_list">
        <h2>포인트부자</h2>
        <table>
            <thead>
                <tr>
                    <th>순위</th>
                    <th>닉네임</th>
                    <th>포인트</th>
                </tr>
            </thead>
            <tbody>
                @php
                $rank = 1 ; 
                @endphp
                @foreach($pointrank as $value)
                <tr>
                    <td>{{$rank}}</td>
                    <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                    <td>{{$value->point}}</td>
                </tr>
                @php
                    $rank++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="loginrank_list">
        <h2>로그인왕</h2>
        <table>
            <thead>
                <tr>
                    <th>순위</th>
                    <th>닉네임</th>
                    <th>로그인횟수</th>
                </tr>
            </thead>
            <tbody>
                @php
                $login = 1 ; 
                @endphp
                @foreach($loginrank as $value)
                <tr>
                    <td>{{$login}}</td>
                    <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                    <td>{{$value->login_count}}</td>
                </tr>
                @php
                    $login++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="itemrank_list">
        <h2>아이템뽑기왕</h2>
        <table>
            <thead>
                <tr>
                    <th>순위</th>
                    <th>닉네임</th>
                    <th>아이템뽑기 횟수</th>
                </tr>
            </thead>
            <tbody>
                @php
                $item = 1 ; 
                @endphp
                @foreach($itemdrawrank as $value)
                <tr>
                    <td>{{$item}}</td>
                    <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                    <td>{{$value->item_draw_count}}</td>
                </tr>
                @php
                    $item++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
