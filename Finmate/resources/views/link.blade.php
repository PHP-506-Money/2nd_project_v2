<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

</head>
<body>
    <header>
        <h2>개인정보 수집 및 이용 동의</h2>
    </header>
    <form class="agreeform" action="{{route('assets.store.post')}}" method="post">
        @csrf
        @if(session()->has('error'))
        <br>
        <div class="message">{{session('error')}}</div>
        @elseif(session()->has('success'))
        <br>
        <div class="message">{{session('success')}}</div>
        @endif
        <article>
            <dl>
                <dt>
                    <div>오픈뱅킹 / 통합자산관리서비스 (금융)거래관계 설정에 필요한 개인정보의 수집 및 이용에 동의해 주세요.</div>
                </dt>
            </dl>
        </article>
        <article>
            <dl>
                <dd>
                    <input type="checkbox" name="agreement" id="agreement" required>
                    <label for="agreement">개인정보 수집 및 이용에 동의합니다.</label>
                </dd>
            </dl>
        </article>
        <article>
            <dl>
                <dt>
                    <label for="name">이름</label>
                </dt>
                <dd>
                    <input type="text" name="name" id="name" required>
                </dd>
            </dl>
        </article>
        <article>
            <dl>
                <dt>
                    <label for="id">아이디</label>
                </dt>
                <dd>
                    <input type="text" name="id" id="id" required>
                </dd>
            </dl>
        </article>
        <article>
            <dl>
                <dt>
                    <label for="password">비밀번호</label>
                </dt>
                <dd>
                    <input type="password" name="password" id="password" required>
                </dd>
            </dl>
        </article>
        <article>
            <dl>
                <dt>
                    <label for="phone">휴대폰</label>
                </dt>
                <dd>
                    <input type="tel" name="phone" id="phone" required>
                </dd>
            </dl>
        </article>
        <article>
            <dl>
                <button class="button min" type="submit">동의 및 정보 제공</button>
                <button class="button min" type="reset">취소 및 재입력</button>
            </dl>
        </article>
    </form>
</body>
</html>



