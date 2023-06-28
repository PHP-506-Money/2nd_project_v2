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
