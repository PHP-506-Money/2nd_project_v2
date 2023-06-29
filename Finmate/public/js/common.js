let cursor = 0;

const scenario = [{
  "name": "모핀",
  "text": "환영합니다. " + username + "님, 무엇을 도와드릴까요?"
},
{
  "name": "모핀",
  "select": []
},
{
  "name": "모핀",
  "text": "다른 것도 도와 드리고 싶은데 필요한 것 있으세요?"
},
{
  "name": "모핀",
  "select2": []
},
{
  "name": "모핀",
  "text": "도움이 되었나요? 좋은 하루 되세요. 다시 시작하고 싶으면 리턴을 눌러 처음 화면으로 돌아갈 수 있습니다."
}

];


const parse = (i = 0) => {
  const {
    text,
    name,
    select,
    select2,
  } = scenario[i];

  //화면 초기화
  document.getElementById('name').style.display = 'none';
  document.getElementById('selector-wrapper').style.display = 'none';
  document.getElementById('selector-wrapper2').style.display = 'none';
  document.getElementById('whoA').style.display = 'none';

  //텍스트 출력
  document.getElementById('text').innerText = text;


  if (!!name) {
    document.getElementById('name').style.display = 'grid';
    document.getElementById('name').innerText = name;
  }

  //선택지 출력
  if (select !== undefined) { // 수정필요한 부분
    document.getElementById('selector-wrapper').style.display = 'grid';
  }
  if (select2 !== undefined) { // 수정필요한 부분
    document.getElementById('selector-wrapper2').style.display = 'grid';
  }

  if (scenario.length - 1 === cursor) {
    document.getElementById('next').style.display = 'none';
  }
};

parse(cursor);

//너는 누구야?
function whoAreYou() {
  document.getElementById("text").innerHTML = `저희들은 당신의 머니 메이트! 가 되고싶은 모핀이들 입니다. 당신의 자산관리를 즐겁게 만들어 주고 싶어서 탄생했어요. 만나서 반갑습니다.  <form><input type="button" value="1.나도 만나서 반가워" onclick="happyMof()"></form><form><input type="button" value="2. 엥? 별론데? 탈퇴할래." onclick="sadMof()"></form>`
  document.getElementById('selector-wrapper').style.display = 'none';
}

function happyMof() {
  document.getElementById("text").innerHTML = `와 그렇게 말씀해 주시니 기뻐요!`;
  document.getElementById('selector-wrapper').style.display = 'none';
  document.getElementById('whole-wrapper').style.backgroundImage = 'url("./img/happy.jpg")';
}

function sadMof() {
  document.getElementById("text").innerHTML = `!!! 열심히 도와드릴테니 한번만 기회를 주세요...`;
  document.getElementById('selector-wrapper').style.display = 'none';
  document.getElementById('whole-wrapper').style.backgroundImage = 'url("./img/sad.jpg")';
}

//기능소개 
function WhatAble(){
  document.getElementById("text").innerHTML = `많은걸 하실 수 있죠! 자산 내역도 볼 수 있고 통계도 볼 수 있고 귀여운모핀이를 꾸밀수도있고.. <form><input type="button" value="1. 포인트는 어떻게 얻어?" onclick="mostAsked()"></form><form><input type="button" value="2. 그밖에 궁금한 것들에 대해 알려줘" onclick="whatElse()"></form>`
  document.getElementById('selector-wrapper').style.display = 'none';
}

function mostAsked(){
  document.getElementById("text").innerHTML = `포인트는 주로 업적을 통해 얻습니다. 앞으로 더 많은 업적과 더 많은 방식이 도입될 예정이니 기대해주세요.`
  document.getElementById('selector-wrapper').style.display = 'none';
}

function whatElse(){
  document.getElementById("text").innerHTML = `그 밖의 궁금하신 점은 고객센터로 연락주시면 성심성의껏 알려드리겠습니다. <br>고객센터 전화번호: 010-1234-5678 <br>핀메이트 이메일: finmate@will.help.you`
  document.getElementById('selector-wrapper').style.display = 'none';

}

//랜덤 메뉴 추천

let randomMenu = ['쌈밥', '사과', '바나나', '베이컨과 계란', '블랙커피', '시리얼', '버섯스프', '치즈버거', '보리굴비', '육전냉면', '우렁강된장', '들깨 수제비'];

function randomItem(randomMenu) {
  return randomMenu[Math.floor(Math.random() * randomMenu.length)];
}

function randomRecomman() {
  document.getElementById("text").innerHTML = `${randomItem(randomMenu)}, 어때요? 맛있을것 같지 않나요? <form><input type="button" value="1.응. 맛있을것같네." onclick="parse(++cursor)"></form><form><input type="button" value="2. 다른건 없을까?" onclick="randomRecomman()"></form>`;
  document.getElementById('selector-wrapper').style.display = 'none';
}





//선택지 한번 더 주기

function selecRe() {
  document.getElementById('selector-wrapper').style.display = 'grid';
  document.getElementById('selector-wrapper2').style.display = 'none';
}