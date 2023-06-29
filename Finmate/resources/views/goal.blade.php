@extends('layout.layout')

@section('title', 'goals')

@section('header', 'GOAL')
@section('contents')

@include('layout.errorsvalidate')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
<h1>나의 목표</h1>

<form action="{{ route('goal.insert',[auth()->user()->userid]) }}" method="post" class="listbox2" id="db1">
    @method('POST')
    @csrf
        <label for="title">목표</label>
        <input type="text" class="" name="title" id="title" required placeholder="목표" >

        <label for="amount">금액</label>
        <input type="number" min="100000" max="1000000000" class="" name="amount" id="amount" required placeholder="목표금액">

        <label for="startperiod">시작일자</label>
        <input type="date" class="" name="startperiod" id="startperiod" required>

        <label for="endperiod">목표일</label>
        <input type="date" class="" name="endperiod" id="endperiod" required >

        <button type="button" class="button" onclick="debouncedSubmitForm()">목표 생성하기</button>
</form>
<br><br>
<h2>진행 목록</h2>

@php
$num = 0;
@endphp

<div class="listbox1">
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
                    <button type="button" class="button" onclick="toggleForm({{ $goal->goalno }})">수정</button>
                </td>
                <td>
                    <form action="{{ route('goal.delete',[auth()->user()->userid]) }}" method="post">
                        @csrf
                        @method('post')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
                        <button type="submit" class="button">삭제</button>
                    </form>
                </td>
            </tr>


            <tr>
                <td colspan="8">
                    <form action="{{ route('goal.update',[auth()->user()->userid]) }}" method="post" id="form_{{ $goal->goalno }}" style="display: none;">
                        @csrf
                        @method('post')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">

                        <div class="">
                            <label for="title">목표</label>
                            <input type="text" class="" name="title" id="title" required placeholder="목표" value="{{ $goal->title }}">
                        </div>

                        <div class="">
                            <label for="amount">금액</label>
                            <input type="number" min="100000" max="1000000000" class="" name="amount" id="amount" required placeholder="목표" value="{{ $goal->amount }}">
                        </div>

                        <div class="">
                            <label for="startperiod">시작일자</label>
                            <input type="date" class="" name="startperiod" id="startperiod" required value="{{ $goal->startperiod }}">
                        </div>

                        <div class="">
                            <label for="endperiod">목표일</label>
                            <input type="date" class="" name="endperiod" id="endperiod" required value="{{ $goal->endperiod }}">
                        </div>

                        <button type="submit" class="button">수정</button>
                        <button type="button" class="button" onclick="cancelForm({{ $goal->goalno }})">취소</button>
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
    <h2>달성 목록</h2>
    @if(isset($data1))
    <table class="table">
        <thead>
            <tr>
                <th>목표</th>
                <th>목표금액</th>
                <th>시작일자</th>
                <th>마감일자</th>
                <th>삭제</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data1 as $goal)
            
            <tr>
                <td>{{ $goal->title }}</td>
                <td>{{ $goal->amount }}</td>
                <td>{{ $goal->startperiod }}</td>
                <td>{{ $goal->endperiod }}</td>
                <td>
                    <form action="{{ route('goal.delete',[auth()->user()->userid]) }}" method="post">
                        @csrf
                        @method('post')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
                        <button type="submit" class="button">삭제</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
<script>
    var debounceTimer;

    function debounce(func, delay) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(func, delay);
    }

    function debouncedSubmitForm() {
        debounce(submitForm, 1000);
    }

    function submitForm() {

        var form = document.getElementById('db1');
        form.submit();
    }

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
