@extends('layout.layout')

@section('title', 'MY TRANSACTIONS')

@section('header', 'MY TRANSACTIONS')

@section('contents')
<!-- 좌우 버튼 -->

<h3>
    <button id="previous-month-btn">&lt;</button><span id="current-month"></span>월<button id="next-month-btn">&gt;</button>
    <br>
    총 수입: <span id="monthly-income"></span> 원
    <br>
    총 지출: <span id="monthly-expense"></span> 원

</h3>



<div class="listbox">
    <a href="{{url('/assets'.'/'.auth()->user()->userid)}}">내 자산 목록 보러가기</a>
    <table>
        <tr>
            <th>자산명</th>
            <th>거래구분</th>
            <th>거래처</th>
            <th>카테고리</th>
            <th>거래금액</th>
            <th>거래일시</th>
        </tr>
        @foreach($transactions as $tran)
        <tr data-month="{{ substr($tran->trantime, 0, 7) }}">
            <td>{{$tran->assetname}}</td>

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

<script>
    const currentMonthElem = document.getElementById("current-month");
    const monthlyIncomeElem = document.getElementById("monthly-income");
    const monthlyExpenseElem = document.getElementById("monthly-expense");
    const previousMonthBtn = document.getElementById("previous-month-btn");
    const nextMonthBtn = document.getElementById("next-month-btn");
    const allRows = document.querySelectorAll(".listbox tr");

    const monthlyIncome = JSON.parse('@json($monthly_income)'.replace(/&quot;/g, '\"'));
    const monthlyExpense = JSON.parse('@json($monthly_expense)'.replace(/&quot;/g, '\"'));

    const today = new Date();
    let currentYear = today.getFullYear();
    let currentMonth = today.getMonth() + 1;
    currentMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth;

    const updateMonthElem = () => {
        const monthStr = `${currentYear}-${currentMonth}`;
        currentMonthElem.textContent = monthStr;
        showByMonth(monthStr);
        monthlyIncomeElem.textContent = monthlyIncome[monthStr] || 0;
        monthlyExpenseElem.textContent = monthlyExpense[monthStr] || 0;
    };

    const showByMonth = (month) => {
        allRows.forEach((row) => {
            if (row.dataset.month === month) row.style.display = "table-row";
            else row.style.display = "none";
        });
    };

    // 초기 표시
    updateMonthElem();

   // 이전 달로 이동
previousMonthBtn.addEventListener("click", () => {
currentMonth = parseInt(currentMonth, 10) - 1;
if (currentMonth < 1) { currentMonth=12; currentYear--; } currentMonth=currentMonth < 10 ? '0' + currentMonth : currentMonth; updateMonthElem(); });



// 다음 달로 이동
nextMonthBtn.addEventListener("click", () => {
currentMonth = parseInt(currentMonth, 10) + 1;
if (currentMonth > 12) {
currentMonth = 1;
currentYear++;
}
currentMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth; updateMonthElem(); });






</script>

@endsection








