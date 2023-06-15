@extends('layout.layout')

@section('title', 'WELCOME TO FINMATE')


@section('header', 'WELCOME TO FINMATE')


@section('contents')

<section>
    <div class="box">
        <div class="text-box">
            <h2>자산관리</h2>

            <div class="subtitle">나도 몰랐던내 돈이 있다고?<br>
                핀메이트 하나로 끝나는 내 자산 관리!<br>
                계좌, 카드, 주식까지 한눈에 다 보여드릴게요.</div>

            <a href="#" class="common-btn">사용해보기</a>

        </div>
    </div>

    <div class="box img">

        <img src="{{ asset('/img/sec1.png') }}" alt="">
    </div>
</section>
<section>
    <div class="box">
        <img src="{{ asset('/img/sec2.jpg') }}" alt="">

    </div>

    <div class="box">
        <div class="text-box">
            <h2>가계부관리</h2>
            <div class="subtitle">가계부 쓰기 귀찮아~<br>
                괜찮아요, 핀메이트가 내역을 관리해주니까!<br>

                입출금 내역, 카드 소비 기록 모두 자동으로 입력해줄게요.</div>

            <a href="#" class="common-btn">사용해보기</a>
        </div>
    </div>
</section>
<section>
    <div class="box">
        <div class="text-box">
            <h2>주식관리</h2>
            <div class="subtitle">무거운 주식 어플, 복잡한 사이트 필요없어요!<br>
                핀메이트에서 간편하게 현재가를 검색하고<br>

                관심 주식을 관리해보세요.</div>


            <a href="#" class="common-btn">사용해보기</a>

        </div>
    </div>
    <div class="box">
    <img src="{{ asset('/img/section2.png') }}" alt="">

        
    </div>

</section>
<section>
    <div class="box">
        <img src="{{ asset('/img/sec4.jpg') }}" alt="">

    </div>

    <div class="box">
        <div class="text-box">
            <h2>통계관리</h2>
            <div class="subtitle">어디에 얼마나 썼는지 한 눈에 볼 수 없나?<br>
                핀메이트가 도와 드릴게요!<br>

                알기쉬운 통계 그래프로 자산 관리를 더 쉽게 해보세요.</div>

            <a href="#" class="common-btn">사용해보기</a>
        </div>
    </div>
</section>
<section>
    <div class="box">
        <div class="text-box">
            <h2>업적관리</h2>
            <div class="subtitle">자산 관리... 해야 하는건 아는데 귀찮아...<br>
                핀메이트가 재미있게 해드릴게요!<br>

                업적 시스템으로 게임처럼 재미있게 <br>자산 관리를 시작해 보세요.</div>

            <a href="#" class="common-btn">사용해보기</a>

        </div>
    </div>
    <div class="box ">
        <img src="{{ asset('/img/section1.jpg') }}" alt="">
    </div>

</section>
<section>

    <div class="bottombanner">
        <img src="{{ asset('/img/mainbottombanner.png') }}" alt="">
    </div>
</section>


@endsection
