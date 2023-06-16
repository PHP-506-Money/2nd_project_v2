@extends('layout.layout')

@section('title', 'WELCOME TO FINMATE')


@section('header', 'WELCOME TO FINMATE')


@section('contents')


@foreach ($assets as $asset)
<p>{{ $asset->userid }}</p>

<p>{{ $asset->assetname }}</p>
<p>{{ $asset->balance }}</p>



@endforeach


@endsection




