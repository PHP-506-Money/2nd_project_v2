@extends('layout.layout')

@section('title', 'Budget')

@section('header', 'BUDGET')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/kja.css')  }}" >
    <main>
    <a href="{{ route('budgetset.get') }}" class = "budget_a">예산 수정</a>
    <div class="monthBudget">
        <p>{{$data['currentMonth']}}달 지출 현황 </p>
        <p>한달 예산 : {{number_format($all)}}원</p>
        <p>사용한 금액 : {{number_format($sumamount)}}원</p>
    </div>
    <br>
    <br>
    <p>주간 지출 현황</p>
    <p>{{$data['startDate']}} ~ {{$data['endDate']}}</p>
    <br>
    <br>
    <div class="leftone">
        <p>남은금액</p>
        @if($all<$sumamount)
            <p> 남은예산이 <br> 없습니다. </p>
        @else
            <p>{{ $data['leftBudget']>0 ? number_format($data['leftBudget'])."원" : "예산 금액을 초과하셨습니다." }}</p>
        @endif
    </div>
    <p class="weekbudget">주간예산 : {{number_format($data['weekBudget'])}}원</p>
    <p>사용금액 : {{number_format($sumweek)}}원</p>
    <br>
    </main>

</body>

@endsection