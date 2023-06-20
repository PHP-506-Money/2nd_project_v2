@extends('layout.layout')

@section('title', 'Budget')

@section('contents')

<canvas id="myChart" height="100px"></canvas>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};

    const data = {
        labels: labels,
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: users,
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                    }
                }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

</script>