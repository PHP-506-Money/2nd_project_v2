@extends('layout.layout')

@section('title', 'Budget')

@section('header', 'BUDGET')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/kja.css')  }}" >

@include('layout.errorsvalidate')
<br>

    @if ($existingBudget)
    <div class = "budgetset">
    <h2>한달 예산 수정하기</h2>
        <form action="{{route('budget.put')}}" method="post">
            @csrf
            @method('PUT')
            <input type="number" name="budgetprice" id="budgetprice" placeholder="예산을 수정해주세요">
            <button type = "submit"> 수정 </button>
            <br>
            <a href="{{ route('budget.get',[auth()->user()->userid])}}" class = "backbtn"> 돌아가기 </a>
            </form>
    </div>
    @else
        <div class = "budgetset">
            <h2>한달 예산 설정하기</h2>
            <form action="{{route('budget.post')}}" method="post">
                @csrf
                <input type="number" name="budgetprice" id="budgetprice" placeholder="예산을 입력해주세요" >
                <button type = "submit"> 설정 </button>
            </form>
        </div>
    @endif

@endsection