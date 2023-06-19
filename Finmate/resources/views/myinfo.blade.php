@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'WELCOME TO FINMATE')


@section('contents')
myinfo

<a href="{{route('users.modify')}}">회원정보 수정</a>
@endsection




