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
            @php
            // UserController의 checkAchievements() 메서드 호출
            $progress = 0;
            $is_achieved = false;
            @endphp
            <tr>
                <th>{{ $achievement->name }}</th>
                <td>{{ $achievement->description }}</td>
                <td>
                    {{-- 진행도를 아이콘, 이미지 또는 텍스트 형식으로 표시 --}}
                    {{ $progress }}%
                </td>
                <td>
                    {{-- 아래 조건을 사용하여 해당 업적이 완료되었는지 여부를 확인 --}}
                    {!! $is_achieved ? '완료' : '미완료' !!}
                </td>
                <td>
                    @if ($is_achieved && !$achievement->reward_received)
                    {{-- 보상받기 버튼을 사용할 수 있는 조건: 완료되었고, 보상 받지 않음 --}}
                    <button onclick="receiveReward({{ $achievement->id }})">보상받기</button>
                    @else
                    <button disabled>보상받기</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function receiveReward(achievementId) {
        fetch('/achievements/' + achievementId + '/reward', {
                method: 'POST'
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

</script>
@endsection






