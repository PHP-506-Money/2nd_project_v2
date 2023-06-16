@extends('layout.layout')

@section('title', 'Budget')

@section('contents')
<link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
<h2>한달 예산 설정하기</h2>
<form action="{{'budget.post'}}" method="post">
@csrf
<input type="number">
<button>설정</button>
</form>
@endsection