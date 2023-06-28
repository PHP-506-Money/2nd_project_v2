// 회원가입 페이지
// ID 체크 변수
const idSpan = document.getElementById('errMsgId');
let apiData = null;

// 아이디 중복체크
function checkDuplicateButton() {
    console.log('start'); // 콘솔로그로 함수가 호출되는지 찍기.
    const id = document.getElementById('id');
    const url = "registration/"+id.value;
    if (id.value === '') { 
        idSpan.innerHTML = "! 아이디를 입력해 주세요.";
        idSpan.style.color = "red";
        return;
    }

        fetch(url)
        .then(data=>{
            // Response Status 확인  (200번 외에는 에러 처리)
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
        .then(apiData =>{
            if(apiData["errorcode"] === "E01"){
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "red";
            } else{
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "green";
            }
        })
        .catch(error=>alert(error.message));
}

// 유효성 체크 함수
function validateInput(input) {
    // 이름 유효성 체크
    if (input.id === 'name') {
    const name = input.value.trim();
    const regex = /^[가-힣a-zA-Z]{2,20}$/;
        if (!regex.test(name)) {
            showErrorMessage(input, '한글, 영문 2~20자 사이로 입력해주세요.');
            return false;
        }
    }

    // 아이디 유효성 체크
    if (input.id === 'id') {
    const id = input.value.trim();
    const regex = /^[a-zA-Z0-9]{4,12}$/;
        if (!regex.test(id)) {
            showErrorMessage(input, '영문, 숫자 4~12자 사이로 입력해주세요.');
            return false;
        }
    }

    // 비밀번호 유효성 체크
    if (input.id === 'password') {
    const password = input.value.trim();
    const regex = /^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[~!@#$%^&*+])(?=.{8,12})/;
        if (!regex.test(password)) {
            showErrorMessage(input, '영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력해주세요.');
            return false;
        }
    }

    // 비밀번호 확인 유효성 체크
    if (input.id === 'passwordchk') {
    const password = document.getElementById('password').value.trim();
    const passwordchk = input.value.trim();
        if (password !== passwordchk) {
            showErrorMessage(input, '비밀번호와 동일하게 입력해주세요.');
            return false;
        }
    }

    // 이메일 유효성 체크
    if (input.id === 'email') {
    const email = input.value.trim();
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regex.test(email)) {
            showErrorMessage(input, '유효한 이메일 주소를 입력해주세요.');
            return false;
        }
    }

    // 휴대폰 번호 유효성 체크
    if (input.id === 'phone') {
    const phone = input.value.trim();
    const regex = /^\d{3}-\d{3,4}-\d{4}$/;
        if (!regex.test(phone)) {
            showErrorMessage(input, '유효한 휴대폰 번호를 입력해주세요. (예: 010-1234-5678)');
            return false;
        } else {
            showErrorMessage(input); // 유효한 비밀번호인 경우 에러 메시지 제거
        }
    }

    hideErrorMessage(input);
    return true;
}
    
// 에러 메시지 표시 함수
function showErrorMessage(input, message) {
    const parent = input.parentElement;
    const errMsgId = parent.querySelector('#errMsgId');
    errMsgId.textContent = message;
    errMsgId.style.display = 'block';
    input.classList.add('error');
}

// 에러 메시지 숨기기 함수
function hideErrorMessage(input) {
    const parent = input.parentElement;
    const errMsgId = parent.querySelector('#errMsgId');
    errMsgId.textContent = '';
    errMsgId.style.display = 'none';
    input.classList.remove('error');
}

// 입력 필드에 입력값이 변경될 때마다 유효성 체크
const form = document.getElementById('form');
const inputs = Array.from(form.querySelectorAll('input'));
inputs.forEach((input) => {
input.addEventListener('input', () => {
    validateInput(input);
    });
});

// 폼 전송 이벤트 핸들러
form.addEventListener('submit', (event) => {
let isValid = true;
inputs.forEach((input) => {
    if (!validateInput(input)) {
    isValid = false;
    }
});

if (!isValid) {
    event.preventDefault();
    }
});

// 프로필 페이지
function btnClick(){
    alert('추후 도입 예정입니다.');
}

function moffinnameChan() {
    if(confirm('모핀이명을 변경하시겠습니까?')){
        document.myinfo.submit();
    } else{
        window.location.reload();
        return false;
    }
}

function confirmWithdrawal() {
    if(confirm("정말로 회원탈퇴 하시겠습니까?")) {
        let withdrawUrl = "/users/withdraw";
        location.href = withdrawUrl;
    } else{
        return false;
    }
}
function toggleitem1() {
    var charitem1 = document.getElementById('charitem1');
    if (charitem1.style.display === 'none') {
        charitem1.style.display = 'block';
    } else {
        charitem1.style.display = 'none';
    }
}
    function toggleitem2() {
    var charitem2 = document.getElementById('charitem2');
    if (charitem2.style.display === 'none') {
        charitem2.style.display = 'block';
    } else {
        charitem2.style.display = 'none';
    }
}
    function toggleitem3() {
    var charitem3 = document.getElementById('charitem3');
    if (charitem3.style.display === 'none') {
        charitem3.style.display = 'block';
    } else {
        charitem3.style.display = 'none';
    }
}
    function toggleitem4() {
    var charitem4 = document.getElementById('charitem4');
    if (charitem4.style.display === 'none') {
        charitem4.style.display = 'block';
    } else {
        charitem4.style.display = 'none';
    }
}
    function toggleitem5() {
    var charitem5 = document.getElementById('charitem5');
    if (charitem5.style.display === 'none') {
        charitem5.style.display = 'block';
    } else {
        charitem5.style.display = 'none';
    }
}
    function toggleitem6() {
    var charitem6 = document.getElementById('charitem6');
    if (charitem6.style.display === 'none') {
        charitem6.style.display = 'block';
    } else {
        charitem6.style.display = 'none';
    }
}
    function toggleitem7() {
    var charitem7 = document.getElementById('charitem7');
    if (charitem7.style.display === 'none') {
        charitem7.style.display = 'block';
    } else {
        charitem7.style.display = 'none';
    }
}
    function toggleitem8() {
    var charitem8 = document.getElementById('charitem8');
    if (charitem8.style.display === 'none') {
        charitem8.style.display = 'block';
    } else {
        charitem8.style.display = 'none';
    }
}
    function toggleitem9() {
    var charitem9 = document.getElementById('charitem9');
    if (charitem9.style.display === 'none') {
        charitem9.style.display = 'block';
    } else {
        charitem9.style.display = 'none';
    }
}
