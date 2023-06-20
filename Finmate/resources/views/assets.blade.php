@extends('layout.layout')

@section('title', 'MY ASSETS')

@section('header', 'MY ASSETS')

@section('contents')



<div class="listbox">

    @if(count($assets) === 0)

    <a onclick="openPopup()">연동하기</a>
    <script>
        function openPopup() {
            window.open('/link','linkAccount', 'width=600,height=400');
            }

    </script>



    <table>
        <tr>
            <td>연동된 자산이 없습니다. 자산을 연동해 주세요.</td>
            <td>연동하기 버튼을 누르면 자산을 연동할 수 있습니다.</td>
        </tr>
    </table>

    @else
    <a href="{{url('/assets/transactions'.'/'.auth()->user()->userid)}}">내 자산 내역 보러가기</a>



    <table>
        <tr>
            <th>자산명</th>
            <th>잔액</th>
        </tr>
        @foreach($assets as $asset)
        <tr>
            <td>{{$asset->assetname}}</td>
            <td>{{number_format($asset->balance)}}원</td>


        </tr>

        @endforeach


    </table>

    

    @endif
</div>










@endsection




