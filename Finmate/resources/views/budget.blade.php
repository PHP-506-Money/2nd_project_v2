@extends('layout.layout')

@section('title', 'Budget')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/test.css')  }}" >
    <main>
    <a href="{{route('budgetset.get')}}">예산 수정</a>
    <div class="monthBudget">
        <p>{{$data[5][2]}}달 지출 현황 </p>
        <p> {{$data[0]->budgetprice}}원</p>
        <p> {{$data[1]}}원</p>
    </div>
    <br>
    <br>
    <p>주간 지출 현황</p>
    <p>{{$data[5][0]}} ~ {{$data[5][1]}}</p>
    <br>
    <br>
    <div class="leftone">
        <p>남은금액</p>
        <p>{{ $data[4]>0 ? $data[4] : "예산 금액을 초과하셨습니다." }}</p>
    </div>
    <p>주간예산 : {{$data[2]}}</p>
    <p>사용금액 : {{$data[3]}}</p>
    <br>
    <p>지난주 지출 : 480,000</p>
    </main>
@endsection