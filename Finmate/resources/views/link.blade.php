<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>개인정보 수집 및 이용 동의</h2>
    <p>오픈뱅킹 / 통합자산관리서비스 (금융)거래관계 설정에 필요한 개인정보의 수집 및 이용에 동의해 주세요.</p>
    <form action="{{route('assets.store.post')}}" method="post">
        @csrf
        <div>{!!session()->has('error') ? session('error') : ""!!}</div>
        <div>{!!session()->has('success') ? session('success') : ""!!}</div>




        <input type="checkbox" name="agreement" id="agreement" required>
        <label for="agreement">개인정보 수집 및 이용에 동의합니다.</label>
        <label for="name">이름</label>
        <input type="text" name="name" id="name" required>
        <label for="id">아이디</label>
        <input type="text" name="id" id="id" required>
        <label for="password">비밀번호</label>
        <input type="password" name="password" id="password" required>
        <label for="phone">휴대폰</label>
        <input type="tel" name="phone" id="phone" required>
        <input type="submit" value="동의및 정보 제공">
    </form>

</body>
</html>



