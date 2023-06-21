@extends('layout.layout')

@section('title', 'MY ACHIEVEMENTS')

@section('header', 'MY ACHIEVEMENTS')


@section('contents')

<div class="container">
    <h1>업적 목록</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">업적명</th>
                <th scope="col">달성조건</th>
                <th scope="col">진행도</th>
                <th scope="col">완료 여부</th>
                <th scope="col">보상 받기</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($achievements as $achievement)

            <tr data-achievement-id="{{ $achievement->id }}">
                <th>{{ $achievement->name }}</th>
                <td>{{ $achievement->description }}</td>

                <td class="progress"></td>
                <td class="achievement-status"></td>

                <td>
                    <button class="receive-reward-button" onclick="receiveReward({{ $achievement->id }})" disabled>보상받기</button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function receiveReward(achievementId) {
        fetch('/achievements/' + achievementId + '/reward', {

                method: 'POST', 
                headers: {
                    'Content-Type': 'application/json'
                    , 'Accept': 'application/json'
                    , 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(json => {
                if (json.error) {
                    alert(json.error);
                } else if (json.success) {
                    alert(json.success);
                    // 새로고침 또는 진행도 및 보상받기 버튼 업데이트를 통해 결과를 표시
                    location.reload();
                }
            })
            .catch(error => {
                console.log('Error:', error);
            });
    }

    fetch('/checkAchievements',  {



    method: 'POST'
    , headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

    }
    })
    .then(response => response.json())
    .then(json => {
    if (json.results) {
    json.results.forEach(result => {
    updateProgressAndAchievementStatus(result);
    });
    }
    })
    .catch(error => {
    console.log('Error:', error);
    });

    function updateProgressAndAchievementStatus(result) {
    const achievementRow = document.querySelector(`[data-achievement-id="${result.id}"]`);
    if (!achievementRow) return;

    achievementRow.querySelector('.progress').innerHTML = `${result.progress}%`;

    const isAchieved = result.is_achieved;
    achievementRow.querySelector('.achievement-status').innerHTML = isAchieved ? '완료' : '미완료';

    const receiveRewardButton = achievementRow.querySelector('.receive-reward-button');
    receiveRewardButton.disabled = !isAchieved || !result.reward_received;
    }

</script>
@endsection






