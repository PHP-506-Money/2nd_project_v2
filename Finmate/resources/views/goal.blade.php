@extends('layout.layout')

@section('title', 'goals')

@section('contents')

<h1>나의 목표</h1>

<form action="{{ route('goal.insert') }}" method="post">
    @method('POST')
    @csrf
    <label for="title">목표 : </label>
    <input type="text" class="" name="title"  id="title" required placeholder="목표">
    
    <label for="amount">금액 : </label>
    <input type="number" class="" name="amount"  id="amount" required placeholder="목표">
    
    <label for="startperiod">시작일자 : </label>
    <input type="datetime-local" name="startperiod"  id="startperiod" required>
    
    <label for="endperiod">목표일 : </label>
    <input type="datetime-local" name="endperiod"  id="endperiod" required>
    
    <button type="submit">목표생성하기</button>
</form>
<br><br>
@if(isset($data))
    @foreach($data as $goal)
        {{'목표 : '.$goal->title }}
        {{'목표금액 : ' .$goal->amount}}
        {{'시작일자 : '. $goal->startperiod }}
        {{' 마감일자 : '. $goal->endperiod }}
        <br>
        <br>

    @endforeach
@endif

@endsection