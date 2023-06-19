{{-- 에러가 있으면 실행 --}}
<span style="margin-bottom: 30px;">
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div style="color: var(--active-color); font-weight: 400;">{{$error}}</div>
        @endforeach
    @endif
</span>

@if(session()->has('error'))
    <div>{!!session('error')!!}</div>
@endif