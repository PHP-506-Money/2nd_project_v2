@extends('layout.layout')

@section('title', 'MY ACHIEVEMENTS')

@section('header', 'MY ACHIEVEMENTS')


@section('contents')

<div class="container">
    <table class="table ">
        <thead>
            <tr>
                <th >업적명</th>
                <th >달성조건</th>
                <th >진행도</th>
                <th >완료 여부</th>
                <th >보상 받기</th>
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
                    <button class="receive-reward-button" onclick="receiveReward({{ $achievement->id }})">보상받기</button>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function receiveReward(achievementId) {
        fetch('/achievements/' + achievementId + '/reward', {
                method: 'PUT'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'Accept': 'application/json'
                    , 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                , }
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


    fetch('/checkAchievements', {
            method: 'GET'
            , headers: {
                'Content-Type': 'application/json'
                , 'Accept': 'application/json'
                , 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            , }
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
        if (!isAchieved) {
        receiveRewardButton.disabled = true;
        receiveRewardButton.classList.add("yet-to-achieve");
        } else {
        receiveRewardButton.classList.remove("yet-to-achieve");
        }

        if (result.reward_received !== "0") {
        receiveRewardButton.disabled = true;
        receiveRewardButton.classList.add("received");
        } else {
        receiveRewardButton.classList.remove("received");
        }


    }

</script>

@endsection

