// ID 체크 변수
const idSpan = document.getElementById('errMsgId');
let apiData = null;

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
            }else{
                idSpan.innerHTML = apiData["msg"];
                idSpan.style.color = "green";
            }
        })
        .catch(error=>alert(error.message));
}

// function btnclick(){
//     alert('이메일 인증 기능은 3차에 도입할 예정입니다.');
// }