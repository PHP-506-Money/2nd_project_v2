@extends('layout.layout')

@section('title', 'WELCOME TO FINMATE')


@section('header', 'WELCOME TO FINMATE')


@section('contents')

<section>
    <div class="box">
        <div class="text-box">
            <h2>예산관리</h2>

            <div class="subtitle">오늘은 얼마까지 쓸 수 있지?<br>
                핀메이트에서 예산을 설정하세요.<br>
                월 수입과 지출을 입력 하면<br>
                모핀이가 일일 예산을 계산해줄게요!</div>


            <a href="#" class="common-btn">사용해보기</a>

        </div>
    </div>

    <div class="box img">

        <img src="{{ asset('/img/section1.png') }}" alt="">
    </div>
</section>
<section>
    <div class="box">
        <img src="{{ asset('/img/character.png') }}" alt="">


    </div>

    <div class="box">
        <div class="text-box">
            <h2>나만의 모핀이 고르기</h2>
            <div class="subtitle">세 마리의 귀여운 동물중<br>
                나의 모핀이를 골라보세요!<br>
                이름도 바꿀 수 있고<br>
                업적 포인트로 꾸며 줄 수도 있어요.</div>
            <a href="#" class="common-btn">사용해보기</a>
        </div>
    </div>
</section>
<section>
    <div class="box">
        <div class="text-box">
            <h2>업적시스템</h2>
            <div class="subtitle">따분한 자산관리 어려운 자산 관리는 그만!<br>

                핀메이트에서 업적을 달성하며 재미있게 관리해 보세요.<br>

                업적에 따른 뱃지와 포인트를 얻을 수 있어요!<br>

                업적에 따른 칭찬과 조언도 있어요!</div>



            <a href="#" class="common-btn">사용해보기</a>

        </div>
    </div>
    <div class="box">
    <img src="{{ asset('/img/char1.png') }}" alt="">

        
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
