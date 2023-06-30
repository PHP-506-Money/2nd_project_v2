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
        @elseif(session()->has('warning'))
        <br>
        <div class="message">{{session('warning')}}</div>
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
                <button class="button min" id="linkButton" type="button">동의 및 정보 제공</button>
                <button class="button min" type="reset">취소 및 재입력</button>
            </dl>
        </article>
    </form>
</body>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('linkButton').addEventListener('click', function() {
        const name = document.getElementById('name').value;
        const id = document.getElementById('id').value;
        const password = document.getElementById('password').value;
        const phone = document.getElementById('phone').value;

        axios.post('{{route('assets.store.post')}}', {
                    name: name
                    , id: id
                    , password: password
                    , phone: phone
                    , _token: '{{csrf_token()}}'
                })
            .then(function(response) {
                if (response.data.success) {
                    alert('연동에 성공했습니다.');
                    window.opener.location.reload();
                    window.close();
                } else if(response.data.successError){
                    window.opener.location.reload();
                    window.close();
                    alert('연동에 실패했습니다. 버튼은 한번만 눌러주세요.');
                } else {
                    alert(response.data.error);
                }
            })
            .catch(function(error) {
                alert('연동에 실패했습니다.'); // 필요한 경우 에러 메시지를 더 자세하게 표시할 수 있습니다.

            });
    });

</script>


</html>



