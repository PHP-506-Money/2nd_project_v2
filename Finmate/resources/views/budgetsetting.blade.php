@extends('layout.layout')

@section('title', 'Budget')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >

@include('layout.errorsvalidate')
<br>
<h2>한달 예산 설정하기</h2>

    @if ($existingBudget)
        <form action="{{route('budget.put')}}" method="post">
            @csrf
            @method('PUT')
            <input type="number" name="budgetprice" id="budgetprice">
            <button type = "submit">설정</button>
            </form>
        @else
        <form action="{{route('budget.post')}}" method="post">
            @csrf
            <input type="number" name="budgetprice" id="budgetprice" value="0" >
            <button type = "submit">설정</button>
        </form>
    @endif

@endsection