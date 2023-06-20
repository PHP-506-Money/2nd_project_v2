@extends('layout.layout')

@section('title', 'goals')

@section('contents')

<h1>나의 목표</h1>

<form action="{{ route('goal.insert',[auth()->user()->userno]) }}" method="post">
    @method('POST')
    @csrf
    <label for="title">목표 : </label>
    <input type="text" class="" name="title"  id="title" required placeholder="목표">
    
    <label for="amount">금액 : </label>
    <input type="number" min="1" max="1000000000" class="" name="amount"  id="amount" required placeholder="목표">
    
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
                <div id="view_{{ $goal->goalno }}" style="display: block;" >
                <form id = "view_form_{{ $goal->goalno }}" action="{{ route('goal.delete',[auth()->user()->userno]) }}" method="post">
                @csrf
                @method('post')
                    <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
                    {{ '목표 : ' . $goal->title }}
                    {{ '목표금액 : ' . $goal->amount }}
                    {{ '시작일자 : ' . $goal->startperiod }}
                    {{ '마감일자 : ' . $goal->endperiod }}
                    <input type="hidden" name="goalcom" value="{{ $goal->completed_at }}">
                    <button type="button" onclick="toggleForm({{ $goal->goalno }})">수정</button>
                    <button type="submit">삭제</button>

            @if($goal->completed_at !== null)
                <script>
                    var viewstyle = 'view_form_{{ $goal->goalno }}';
                    var view1 = document.getElementById(viewstyle);
                    if (view1) {
                        view1.style.backgroundColor = "gray";
                    }
                </script>
            @endif
                </form>
                </div>

                <form action="{{ route('goal.update',[auth()->user()->userno]) }}" method="post" id="form_{{ $goal->goalno }}" style="display: none;">
                    @csrf 
                    @method('post')
                    <input type="hidden" name="goalno" value="{{ $goal->goalno }}">

                    <label for="title">목표 : </label>
                    <input type="text" name="title" id="title" required placeholder="목표" value="{{ $goal->title }}">

                    <label for="amount">금액 : </label>
                    <input type="number" min="1" max="1000000000" name="amount" id="amount" required placeholder="목표" value="{{ $goal->amount }}">

                    <label for="startperiod">시작일자 : </label>
                    <input type="date" name="startperiod" id="startperiod" required value="{{ $goal->startperiod }}">

                    <label for="endperiod">목표일 : </label>
                    <input type="date" name="endperiod" id="endperiod" required value="{{ $goal->endperiod }}">

                    <button type="submit">수정</button>
                    <button type="button"onclick="cancelForm({{ $goal->goalno }})">취소</button>
                </form>
            </div>
        
    @endforeach
@endif
<script>

    function toggleForm(goalno) {
        
        var formId = 'form_' + goalno;
        var form = document.getElementById(formId);
        var viewId = 'view_' + goalno;
        var view = document.getElementById(viewId);
        
    
        if (form.style.display === 'none') {
            form.style.display = 'block'
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