@extends('layout.layout')

@section('title', 'goals')

@section('contents')

<h1>나의 목표</h1>

<form action=""method="">

    <label for="title">목표 : </label>
    <input type="text" class="" name="title"  id="title" required placeholder="목표">
    <br>
    <label for="amount">금액 : </label>
    <input type="number" class="" name="amount"  id="amount" required placeholder="목표">
    <br>
    <label for="startperiod">시작일자 : </label>
    <input type="datetime-local" name="startperiod"  id="startperiod" required>
    <br>
    <label for="endperiod">목표일 : </label>
    <input type="datetime-local" name="endperiod"  id="endperiod" required>
    <br>
    <button type="submit">목표생성하기</button>
</form>


@endsection