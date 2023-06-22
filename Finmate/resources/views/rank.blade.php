@extends('layout.layout')

@section('title', 'rank')

@section('header', 'Rank')

@section('contents')

@php
$rank = 1 ; 
@endphp
<div>
@foreach($data as $value)
    {{$rank}}
    {{'닉네임 : '.$value->username}}
    <pre>{{' 포인트 : '.$value->point}}</pre>
    
    <br>
    @php
        $rank++;
    @endphp
@endforeach
</div>



@endsection