@extends('layout.layout')

@section('title', 'WELCOME TO FINMATE')


@section('header', 'WELCOME TO FINMATE')


@section('contents')
<p>test</p>
@foreach($assets as $asset)

    <ul>
        <li>자산명</li>
        <li>{{$asset->assetname}}</li>

    </ul>
    <ul>
        <li>잔액</li>
        <li>{{$asset->balance}}</li>

    </ul>

@endforeach

@endsection




