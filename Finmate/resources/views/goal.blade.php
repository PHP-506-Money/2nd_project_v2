@extends('layout.layout')

@section('title', 'goals')

@section('header', 'GOAL')
@section('contents')
@include('layout.errorsvalidate')
<h1>나의 목표</h1>

<form action="{{ route('goal.insert',[auth()->user()->userid]) }}" method="post">
    @method('POST')
    @csrf
    <div class="form-group">
        <label for="title">목표</label>
        <input type="text" class="form-control" name="title" id="title" required placeholder="목표">
    </div>

    <div class="form-group">
        <label for="amount">금액</label>
        <input type="number" min="100000" max="1000000000" class="form-control" name="amount" id="amount" required placeholder="목표">
    </div>

    <div class="form-group">
        <label for="startperiod">시작일자</label>
        <input type="date" class="form-control" name="startperiod" id="startperiod" required>
    </div>

    <div class="form-group">
        <label for="endperiod">목표일</label>
        <input type="date" class="form-control" name="endperiod" id="endperiod" required>
    </div>

    <button type="submit" class="btn btn-primary">목표 생성하기</button>
</form>
<br><br>
<h2>목록</h2>

@php
$num = 0;
@endphp

<div class="listbox1" style="background-color: #FFFBF0;">
    @if(isset($data))
    <table class="table">
        <thead>
            <tr>
                <th>목표</th>
                <th>목표금액</th>
                <th>시작일자</th>
                <th>마감일자</th>
                <th>진행금액</th>
                <th>달성률</th>
                <th>수정</th>
                <th>삭제</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $goal)
            <tr>
                <td>{{ $goal->title }}</td>
                <td>{{ $goal->amount }}</td>
                <td>{{ $goal->startperiod }}</td>
                <td>{{ $goal->endperiod }}</td>
                <td>{{ number_format($goalint[$num]) }}</td>
                <td>{{ ceil(($goalint[$num]/$goal->amount)*100).'%' }}</td>
                <td>
                    <button type="button" class="btn btn-primary" onclick="toggleForm({{ $goal->goalno }})">수정</button>
                </td>
                <td>
                    <form action="{{ route('goal.delete',[auth()->user()->userid]) }}" method="post">
                        @csrf
                        @method('post')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
                        <button type="submit" class="btn btn-danger">삭제</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <form action="{{ route('goal.update',[auth()->user()->userid]) }}" method="post" id="form_{{ $goal->goalno }}" style="display: none;">
                        @csrf
                        @method('post')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">

                        <div class="form-group">
                            <label for="title">목표</label>
                            <input type="text" class="form-control" name="title" id="title" required placeholder="목표" value="{{ $goal->title }}">
                        </div>

                        <div class="form-group">
                            <label for="amount">금액</label>
                            <input type="number" min="100000" max="1000000000" class="form-control" name="amount" id="amount" required placeholder="목표" value="{{ $goal->amount }}">
                        </div>

                        <div class="form-group">
                            <label for="startperiod">시작일자</label>
                            <input type="date" class="form-control" name="startperiod" id="startperiod" required value="{{ $goal->startperiod }}">
                        </div>

                        <div class="form-group">
                            <label for="endperiod">목표일</label>
                            <input type="date" class="form-control" name="endperiod" id="endperiod" required value="{{ $goal->endperiod }}">
                        </div>

                        <button type="submit" class="btn btn-primary">수정</button>
                        <button type="button" class="btn btn-secondary" onclick="cancelForm({{ $goal->goalno }})">취소</button>
                    </form>
                </td>
            </tr>
            @php
            $num++;
            @endphp
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<script>
    function toggleForm(goalno) {
        var formId = 'form_' + goalno;
        var form = document.getElementById(formId);
        var viewId = 'view_' + goalno;
        var view = document.getElementById(viewId);

        if (form.style.display === 'none') {
            form.style.display = 'block';
            view.style.display = 'none';
        } else {
            form.style.display = 'none';
        }
    }

    function cancelForm(goalno) {
        var formId = 'form_' + goalno;
        var form = document.getElementById(formId);
        var viewId = 'view_' + goalno;
        var view = document.getElementById(viewId);

        form.style.display = 'none';
        view.style.display = 'block';
    }
</script>
@endsection
