@extends('layout.layout')

@section('title', 'MY TRANSACTIONS')

@section('header', 'MY TRANSACTIONS')

@section('contents')

<div class="listbox">
    <a href="{{url('/assets'.'/'.auth()->user()->userid)}}">내 자산 목록 보러가기</a>
    <table>
        <tr>
            <th>거래구분</th>
            <th>거래처</th>
            <th>카테고리</th>
            <th>거래금액</th>
            <th>거래일시</th>
        </tr>
        @foreach($transactions as $tran)
        <tr>

            @if($tran->type == '0')
                <td>입금</td>
            @else
                <td>출금</td>
            @endif
            
            <td>{{$tran->payee}}</td>
            @if($tran->type == '0')
            <td>수입</td>
            @else
            <td>{{$tran->char}}</td>

            @endif

            
            @if($tran->type == '0')
            <td>{{number_format($tran->amount)}}원</td>

            @else
            <td>-{{number_format($tran->amount)}}원</td>

            @endif

            
            <td>{{$tran->trantime}}</td>

        </tr>

        @endforeach


    </table>

    

</div>



@endsection




