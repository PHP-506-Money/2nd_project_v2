@extends('layout.layout')

@section('title', 'Budget')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >

@include('layout.errorsvalidate')

<div>{{ session('error') }}</div>
<h2>한달 예산 설정하기</h2>
<form action="{{route('budget.post')}}" method="post">
@csrf
<input type="number" name="budgetprice" id="budgetprice" >
<button type = "submit">설정</button>
</form>
@endsection