@extends('layout.layout')

@section('title', 'static')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{ asset('/css/test.css')  }}" >
@section('contents')
<p>월별 입지출 내역</p>

<form action="" method="get">
@csrf
<button type="submit" > < </button>
<p>{{$date[0]}}</p>
<button > > </button>
</form>



<div class = "chartB">
<canvas id="monthChart" ></canvas>
</div>
<br>
<br>

<p>카테고리별 지출 내역</p>
<div class = "chartD">
<canvas id="categoryChart" ></canvas>
</div>

@foreach($catdata as $data)
    <p>{{$data->category}}</p>
    <p>{{$data->consumption}}</p>
@endforeach

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
                position: 'right'
            }
        }
    }
});
        </script>
@endsection
