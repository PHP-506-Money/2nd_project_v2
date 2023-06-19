@extends('layout.layout')

@section('title', 'goals')

@section('contents')

<h1>나의 목표</h1>
{{-- @php
    var_dump(session()->all());
@endphp --}}
<form action="{{ route('goal.insert',[auth()->user()->userno]) }}" method="post">
    @method('POST')
    @csrf
    <label for="title">목표 : </label>
    <input type="text" class="" name="title"  id="title" required placeholder="목표">
    
    <label for="amount">금액 : </label>
    <input type="number" class="" name="amount"  id="amount" required placeholder="목표">
    
    <label for="startperiod">시작일자 : </label>
    <input type="date" name="startperiod"  id="startperiod" required>
    
    <label for="endperiod">목표일 : </label>
    <input type="date" name="endperiod"  id="endperiod" required>
    
    <button type="submit">목표생성하기</button>
</form>
<br><br>
<h2>목록</h2>
@if(isset($data))
    @foreach($data as $goal)
    <div>
    <form action="" method="post">
    
    <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
    <label for="title">목표 : </label>
    <input type="text" class="" name="title"  id="title" required placeholder="목표" value="{{ $goal->title }}" >
    
    <label for="amount">금액 : </label>
    <input type="number" class="" name="amount"  id="amount" required placeholder="목표" value="{{ $goal->amount }}">
    
    <label for="startperiod">시작일자 : </label>
    <input type="date" name="startperiod"  id="startperiod" required value="{{ $goal->startperiod }}">
    
    <label for="endperiod">목표일 : </label>
    <input type="date" name="endperiod"  id="endperiod" required value="{{ $goal->endperiod }}" >
    {{'   '}}<button>수정</button>{{'   '}}<button>삭제</button>
    <br><br>
    </form>
    </div>
        {{-- {{'목표 : '.$goal->title }}
        {{'목표금액 : ' .$goal->amount}}
        {{'시작일자 : '. $goal->startperiod }}
        {{' 마감일자 : '. $goal->endperiod }}
        {{'   '}}<button>수정</button>{{'   '}}<button>삭제</button>
        <br>
        <br> --}}
    
    @endforeach
@endif

@endsection