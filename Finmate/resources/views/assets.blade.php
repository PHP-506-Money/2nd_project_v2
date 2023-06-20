@extends('layout.layout')

@section('title', 'MY ASSETS')

@section('header', 'MY ASSETS')

@section('contents')
<div>
    <table class="scriptCalendar">
        <thead>
            <tr>
                <td class="calendarBtn" id="btnPrevCalendar">&#60;&#60;</td>
                <td colspan="5">
                    <span id="calYear">YYYY</span>년
                    <span id="calMonth">MM</span>월
                </td>
                <td class="calendarBtn" id="nextNextCalendar">&#62;&#62;</td>
            </tr>
            <tr>
                <td>일</td>
                <td>월</td>
                <td>화</td>
                <td>수</td>
                <td>목</td>
                <td>금</td>
                <td>토</td>
            </tr>
        </thead>
        <tbody class="scriptCalendarVal"></tbody>

    </table>
</div>


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




<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        buildCalendar();

        document.getElementById("btnPrevCalendar").addEventListener("click", function(event) {
            prevCalendar();
        });

        document.getElementById("nextNextCalendar").addEventListener("click", function(event) {
            nextCalendar();
        });
    });

    var toDay = new Date(); // @param 전역 변수, 오늘 날짜 / 내 컴퓨터 로컬을 기준으로 toDay에 Date 객체를 넣어줌
    var nowDate = new Date(); // @param 전역 변수, 실제 오늘날짜 고정값

    /**
     * @brief   이전달 버튼 클릭시
     */
    function prevCalendar() {
        this.toDay = new Date(toDay.getFullYear(), toDay.getMonth() - 1, toDay.getDate());
        buildCalendar(); // @param 전월 캘린더 출력 요청
    }

    /**
     * @brief   다음달 버튼 클릭시
     */
    function nextCalendar() {
        this.toDay = new Date(toDay.getFullYear(), toDay.getMonth() + 1, toDay.getDate());
        buildCalendar(); // @param 명월 캘린더 출력 요청
    }

    /**
     * @brief   캘린더 오픈
     * @details 날짜 값을 받아 캘린더 폼을 생성하고, 날짜값을 채워넣는다.
     */
    function buildCalendar() {

        let doMonth = new Date(toDay.getFullYear(), toDay.getMonth(), 1);
        let lastDate = new Date(toDay.getFullYear(), toDay.getMonth() + 1, 0);

        let tbCalendar = document.querySelector(".scriptCalendar > tbody");

        document.getElementById("calYear").innerText = toDay.getFullYear(); // @param YYYY월
        document.getElementById("calMonth").innerText = autoLeftPad((toDay.getMonth() + 1), 2); // @param MM월


        // @details 이전 캘린더의 출력결과가 남아있다면, 이전 캘린더를 삭제한다.
        while (tbCalendar.rows.length > 0) {
            tbCalendar.deleteRow(tbCalendar.rows.length - 1);
            // clearTransactionAmounts();
        }

        // @param 첫번째 개행
        let row = tbCalendar.insertRow();

        // @param 날짜가 표기될 열의 증가값
        let dom = 1;

        // @details 시작일의 요일값( doMonth.getDay() ) + 해당월의 전체일( lastDate.getDate())을  더해준 값에서
        //               7로 나눈값을 올림( Math.ceil() )하고 다시 시작일의 요일값( doMonth.getDay() )을 빼준다.
        let daysLength = (Math.ceil((doMonth.getDay() + lastDate.getDate()) / 7) * 7) - doMonth.getDay();

        // @param 달력 출력
        // @details 시작값은 1일을 직접 지정하고 요일값( doMonth.getDay() )를 빼서 마이너스( - )로 for문을 시작한다.
        for (let day = 1 - doMonth.getDay(); daysLength >= day; day++) {

            let column = row.insertCell();

            // @param 평일( 전월일과 익월일의 데이터 제외 )
            if (Math.sign(day) == 1 && lastDate.getDate() >= day) {

                // @param 평일 날짜 데이터 삽입
                column.innerText = autoLeftPad(day, 2);

                // @param 일요일인 경우
                if (dom % 7 == 1) {
                    column.style.color = "#FF4D4D";
                }

                // @param 토요일인 경우
                if (dom % 7 == 0) {
                    column.style.color = "#4D4DFF";
                    row = tbCalendar.insertRow(); // @param 토요일이 지나면 다시 가로 행을 한줄 추가한다.
                }

            }

            // @param 평일 전월일과 익월일의 데이터 날짜변경
            else {
                let exceptDay = new Date(doMonth.getFullYear(), doMonth.getMonth(), day);
                column.innerText = autoLeftPad(exceptDay.getDate(), 2);
                column.style.color = "#A9A9A9";
            }

            // @brief   전월, 명월 음영처리
            // @details 현재년과 선택 년도가 같은경우
            if (toDay.getFullYear() == nowDate.getFullYear()) {

                // @details 현재월과 선택월이 같은경우
                if (toDay.getMonth() == nowDate.getMonth()) {

                    // @details 현재일보다 이전인 경우이면서 현재월에 포함되는 일인경우
                    if (nowDate.getDate() > day && Math.sign(day) == 1) {
                        column.style.cursor = "pointer";
                        column.style.color = "#607EAA";

                        column.onclick = function() {
                        calendarChoiceDay(this);
                        }

                    }

                    // @details 현재일보다 이후이면서 현재월에 포함되는 일인경우
                    else if (nowDate.getDate() < day && lastDate.getDate() >= day) {

                        column.style.cursor = "pointer";
                        column.onclick = function() {
                            calendarChoiceDay(this);
                        }
                    }

                    // @details 현재일인 경우
                    else if (nowDate.getDate() == day) {
                        column.style.backgroundColor = "#FF7676";

                        column.style.cursor = "pointer";
                        column.onclick = function() {
                            calendarChoiceDay(this);
                        }
                    }

                    // @details 현재월보다 이전인경우
                } else if (toDay.getMonth() < nowDate.getMonth()) {
                    if (Math.sign(day) == 1 && day <= lastDate.getDate()) {
                        column.style.cursor = "pointer";
                        column.style.color = "#607EAA";

                        column.onclick = function() {
                        calendarChoiceDay(this);
                        }

                    }
                }

                // @details 현재월보다 이후인경우
                else {
                    if (Math.sign(day) == 1 && day <= lastDate.getDate()) {
                        column.style.cursor = "pointer";
                        column.onclick = function() {
                            calendarChoiceDay(this);
                        }
                    }
                }
            }

            // @details 선택한년도가 현재년도보다 작은경우
            else if (toDay.getFullYear() < nowDate.getFullYear()) {
                if (Math.sign(day) == 1 && day <= lastDate.getDate()) {
                }
            }

            // @details 선택한년도가 현재년도보다 큰경우
            else {
                if (Math.sign(day) == 1 && day <= lastDate.getDate()) {
                    column.style.cursor = "pointer";
                    column.onclick = function() {
                        calendarChoiceDay(this);
                    }
                }
            }
            
            dom++;
        }
        @if(count($transactions) > 0)

        const transactions = @json($transactions);

    function showTransactionAmounts() {
    if (document.querySelector("tbody.scriptCalendarVal")) {

    let calendarCells = document.querySelectorAll("tbody.scriptCalendarVal > tr > td");


    for (let i = 0; i < calendarCells.length; i++) { const cell=calendarCells[i]; const date=new Date(toDay.getFullYear(), toDay.getMonth(), parseInt(cell.innerText)); let depositAmount=0; let withdrawalAmount=0; transactions.forEach(transaction=> {
        const transactionDate = new Date(transaction.trantime);

        if (transactionDate.toDateString() === date.toDateString()) {
        if (transaction.type === '0') {
        depositAmount += transaction.amount;
        } else {
        withdrawalAmount += transaction.amount;
        }
        }
        });

        if (depositAmount > 0 || withdrawalAmount > 0) {
        const amounts = document.createElement('div');
        amounts.innerHTML = `<span style="color: blue">+${depositAmount}</span><br><span style="color: red">-${withdrawalAmount}</span>`;
        cell.appendChild(amounts);
        }
        }
        }
        }

        // function clearTransactionAmounts() {
       //  let calendarCells = document.querySelectorAll("td");
       //  for (let i = 0; i < calendarCells.length; i++) { const cell=calendarCells[i]; const amountsDiv=cell.querySelector('div'); if (amountsDiv) { cell.removeChild(amountsDiv); } } }

        showTransactionAmounts();

        @endif


    }

    /**
     * @brief   날짜 선택
     * @details 사용자가 선택한 날짜에 체크표시를 남긴다.
     */
    function calendarChoiceDay(column) {

        // @param 기존 선택일이 존재하는 경우 기존 선택일의 표시형식을 초기화 한다.
        if (document.getElementsByClassName("choiceDay")[0]) {

            // @see 금일인 경우
            if (document.getElementById("calMonth").innerText == autoLeftPad((nowDate.getMonth() + 1), 2) && document.getElementsByClassName("choiceDay")[0].innerText == autoLeftPad(toDay.getDate(), 2)) {
                document.getElementsByClassName("choiceDay")[0].style.backgroundColor = "#FFFFE6";
            }

            // @see 금일이 아닌 경우
            else {
                document.getElementsByClassName("choiceDay")[0].style.backgroundColor = "#FFFBF0";

            }
            document.getElementsByClassName("choiceDay")[0].classList.remove("choiceDay");
        }

        // @param 선택일 체크 표시
        column.style.backgroundColor = "#FF9999";

        // @param 선택일 클래스명 변경
        column.classList.add("choiceDay");
    }

    /**
     * @brief   숫자 두자릿수( 00 ) 변경
     * @details 자릿수가 한자리인 ( 1, 2, 3등 )의 값을 10, 11, 12등과 같은 두자리수 형식으로 맞추기위해 0을 붙인다.
     * @param   num     앞에 0을 붙일 숫자 값
     * @param   digit   글자의 자릿수를 지정 ( 2자릿수인 경우 00, 3자릿수인 경우 000 … )
     */
    function autoLeftPad(num, digit) {
        if (String(num).length < digit) {
            num = new Array(digit - String(num).length + 1).join("0") + num;
        }
        return num;
    }

</script>





@endsection




