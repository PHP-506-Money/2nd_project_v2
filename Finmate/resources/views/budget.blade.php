@extends('layout.layout')

@section('title', 'Budget')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/test.css')  }}" >
    <main>
    <a href="{{ route('budgetset.get') }}">예산 수정</a>
    <div class="monthBudget">
        <p>{{$data[2]}}달 지출 현황 </p>
        <p>한달 예산 : {{number_format($all)}}원</p>
        <p>사용한 금액 : {{number_format($sumamount)}}원</p>
    </div>
    <br>
    <br>
    <p>주간 지출 현황</p>
    <p>{{$data[0]}} ~ {{$data[1]}}</p>
    <br>
    <br>
    <div class="leftone">
        <p>남은금액</p>
        <p>{{ $data[4]>0 ? number_format($data[4]) : "예산 금액을 초과하셨습니다." }}</p>
    </div>
    <p>주간예산 : {{number_format($data[3])}}</p>
    <p>사용금액 : {{number_format($sumweek)}}</p>
    <br>
    </main>

</body>

@endsection