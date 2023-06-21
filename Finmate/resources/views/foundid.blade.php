@extends('layout.layout')

@section('title', 'FindID')

@section('contents')
    <h1>아이디 찾기 결과</h1>
    @if (isset($foundId))
        <p>찾은 아이디: {{ $foundId }}</p>
    @else
        <p>아이디를 찾을 수 없습니다.</p>
    @endif
@endsection