@extends('layout.layout')

@section('title', 'static')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script> 
<link rel="stylesheet" href="{{ asset('/css/test.css')  }}" >

@section('contents')

<p>{{ $currentYear }}년 월별 입지출 내역</p>

<form action=" {{ route('static.get',[auth()->user()->userid])}}" method="get">
@csrf
<button type="submit" id="year" name="year" value="2021"> 2021 </button>
<button type="submit" id="year" name="year" value="2022"> 2022 </button>
<button type="submit" id="year" name="year" value="2023"> 2023 </button>
</form> 

<div class = "chartB">
<canvas id="monthChart" ></canvas>
</div>
<article>

<p>카테고리별 지출 내역</p>
    <p>{{$date['startDate']}} ~ {{$date['endDate']}}</p>
<div class = "chartD">

<div class ="categoryChart">
        <canvas id="categoryChart" ></canvas>

    @foreach($percent as $data)
        <p>{{$data}}</p>
    @endforeach
    
    @foreach($catdata as $data)
        <div class="catdetail">
            <p>{{$data->category}}</p>
            <p>{{number_format($data->consumption)}}</p>
        </div>
    @endforeach
</div>
</article>

<p>최대 지출 카테고리  : {{$catdata[0]->category}}</p>


<script>
        let monthrcLabels = [];
        let monthrcData = [];

        @foreach($monthrc as $data)
            monthrcLabels.push("{{ $data->Month }}");
            monthrcData.push({{ $data->consumption }});
        @endforeach

        let monthexData = [];

        @foreach($monthex as $data)
            monthexData.push({{ $data->consumption }});
        @endforeach
        
        let categoryLabels = [];
        let categoryData = [];

        @foreach($catdata as $data)
            categoryLabels.push("{{ $data->category }}");
            categoryData.push({{ $data->consumption }});
        @endforeach

        var monthChart = new Chart(document.getElementById('monthChart'), {
            type: 'bar',
            data: {
                labels: monthrcLabels,
                datasets: [{
                    label: '월별 입금',
                    data: monthrcData,
                    backgroundColor: '#f07167',
                    borderColor: '#f07167',
                    borderWidth: 1
                    },
                    {
                    label: '월별 지출',
                    data: monthexData,
                    backgroundColor: '#b5e2fa',
                    borderColor: '#b5e2fa',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var categoryChart = new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: '지출',
                data: categoryData,
                backgroundColor: [
                    '#ffadad',
                    '#ffd6a5',
                    '#fdffb6',
                    '#d0f4de',
                    '#bde0fe',
                    '#a8dadc',
                    '#b8c0ff',
                    '#ffc8dd'
                ],
                borderColor: [
                    '#ffadad',
                    '#ffd6a5',
                    '#fdffb6',
                    '#d0f4de',
                    '#bde0fe',
                    '#a8dadc',
                    '#b8c0ff',
                    '#ffc8dd'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            cutoutPercentage: 60,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<div id="myModal" class="modal" >
    <!-- Modal content -->
    <div class="modal-content">
        <p>연동된 자산이 없습니다.</p>
        <p>자산을 연동해주세요.</p>
        <p><br /></p>
        <div style="cursor:pointer;background-color:#DDDDDD;text-align: center;padding-bottom: 10px;padding-top: 10px;" onClick="redirectToStatic()">
            <span class="pop_bt" style="font-size: 13pt;">
                연동하러 가기
            </span>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function() {
        if ('{{ session('modal') }}') {
            document.getElementById('myModal').style.display = 'block';
        }
    });

    function redirectToStatic() {
        window.location.href = '/static/{{ $userid }}';
    }
</script>
@endsection
