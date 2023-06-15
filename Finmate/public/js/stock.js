//--------------------------------------------
// 주식 현재가 가져오기
// 2023-06-13 최혁재  
//**** 토큰 하루마다 업데이트 해줘야합니다 */
//---------------------------------------------

    // var volume = document.getElementById('volume')
    // var url = 'http://cors-anywhere.herokuapp.com/https://openapi.koreainvestment.com:9443/uapi/domestic-stock/v1/quotations/inquire-price?FID_COND_MRKT_DIV_CODE=J&FID_INPUT_ISCD=005930';

    // fetch(url, {
    // method: 'GET',
    // headers: {
    //     'Content-Type': 'application/json; charset=utf-8',
    //     'authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJ0b2tlbiIsImF1ZCI6IjRjMGY5Y2M3LTJmNmYtNDgzYi05NzdiLTg4NDM0ZmFlYTI1MCIsImlzcyI6InVub2d3IiwiZXhwIjoxNjg2NzE1MjE5LCJpYXQiOjE2ODY2Mjg4MTksImp0aSI6IlBTY0xJUUdVQWt1bTZ3RjY4WG5LMGpLMEU3UE40T0hOeGNXYiJ9.RYvSOBVo9BEUfjrFbgqpY5vHO_ByzcKvosFkrbqjbyMJqpe141z0BlPs1qFKeCSLkT1IfirTxi5HsYmgfgLQ5g',
    //     'appKey': 'PScLIQGUAkum6wF68XnK0jK0E7PN4OHNxcWb',
    //     'appSecret': 'z3Z/GX38jOd6ree4VjlNxmKSm5b7XOrC7GJgG8Qsbdg4tOxwKpAQe+v+h90gNHR503cBWv/3QlXu3cFdGUPLD7mGp+kyqc3vd4fFf78ZZJZquRmax7JRtayhUmvy7CQph1i94KH7gHTlpOCgYuN7kIT04qH11vrUSD4lHxfPp/Nn7o2t2S0=',
    //     'tr_id': 'FHKST01010100'
    // },
    // })
    // .then(function(response) {
    // console.log('Status : ' + response.status + '\nHeaders: ' + JSON.stringify(response.headers));
    // return response.json(); // 응답 본문을 JSON으로 변환하여 반환
    // })
    // .then(function(body) {
    //     var jsondata = JSON.stringify(body);
    //     var data = JSON.parse(jsondata);
    //     document.getElementById('volume').innerText='종목 구분:'+data.output['bstp_kor_isnm']+'\n';// 종목
    //     document.getElementById('volume').innerText+='현재가:'+data.output['stck_prpr']+'\n';//현재가
    //     document.getElementById('volume').innerText+='증거금 비율:'+data.output['marg_rate']+'\n';//증거금비율
    //     document.getElementById('volume').innerText+='전일대비:'+data.output['prdy_vrss']+'\n';//전일대비 가격차이
    //     document.getElementById('volume').innerText+='시가:'+data.output['stck_oprc']+'\n';//시가
    //     document.getElementById('volume').innerText+='저가:'+data.output['stck_lwpr']+'\n';//저가
    //     document.getElementById('volume').innerText+='고가:'+data.output['stck_hgpr']+'\n';//저가

    // })
    // .catch(function(error) {
    //     console.log('Error:', error);
    // });
    
    //--------------------------------------------
    //****for each로 돌리기 */
//    var output = data.output;
//    Object.keys(output).forEach(function(key) {
//    document.getElementById('volume').innerText += key + ": " + output[key];
// });
    
// 주식 거래량 상위 가져오기
// 2023-06-13 최혁재  
//**** 토큰 하루마다 업데이트 해줘야합니다 */
//---------------------------------------------

var url = 'http://cors-anywhere.herokuapp.com/https://openapi.koreainvestment.com:9443/uapi/domestic-stock/v1/quotations/volume-rank?FID_COND_MRKT_DIV_CODE=J&FID_COND_SCR_DIV_CODE=20171&FID_INPUT_ISCD=0000&FID_DIV_CLS_CODE=0&FID_BLNG_CLS_CODE=0&FID_TRGT_CLS_CODE=333333333&FID_TRGT_EXLS_CLS_CODE=000000&FID_INPUT_PRICE_1= &FID_INPUT_PRICE_2= &FID_VOL_CNT= &FID_INPUT_DATE_1=230611';

    fetch(url, {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json; charset=utf-8',
        'authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJ0b2tlbiIsImF1ZCI6IjRjMGY5Y2M3LTJmNmYtNDgzYi05NzdiLTg4NDM0ZmFlYTI1MCIsImlzcyI6InVub2d3IiwiZXhwIjoxNjg2NzE1MjE5LCJpYXQiOjE2ODY2Mjg4MTksImp0aSI6IlBTY0xJUUdVQWt1bTZ3RjY4WG5LMGpLMEU3UE40T0hOeGNXYiJ9.RYvSOBVo9BEUfjrFbgqpY5vHO_ByzcKvosFkrbqjbyMJqpe141z0BlPs1qFKeCSLkT1IfirTxi5HsYmgfgLQ5g',
        'appKey': 'PScLIQGUAkum6wF68XnK0jK0E7PN4OHNxcWb',
        'appSecret': 'z3Z/GX38jOd6ree4VjlNxmKSm5b7XOrC7GJgG8Qsbdg4tOxwKpAQe+v+h90gNHR503cBWv/3QlXu3cFdGUPLD7mGp+kyqc3vd4fFf78ZZJZquRmax7JRtayhUmvy7CQph1i94KH7gHTlpOCgYuN7kIT04qH11vrUSD4lHxfPp/Nn7o2t2S0=',
        'tr_id': 'FHPST01710000',
        'custtype': 'P'
    },
    // body: JSON.stringify({
    //     "FID_COND_MRKT_DIV_CODE": "J",
    //     "FID_INPUT_ISCD": "005930"
    // })
    })
    .then(function(response) {
    console.log('Status : ' + response.status + '\nHeaders: ' + JSON.stringify(response.headers));
    return response.json(); // 응답 본문을 JSON으로 변환하여 반환
    })
    .then(function(body) {
        // console.log('Body : ' + JSON.stringify(body));
        var jsondata1 = JSON.stringify(body);
        var data1 = JSON.parse(jsondata1)
        console.log(data1.output[0]['hts_kor_isnm']);
        console.log(data1.output[0]['avrg_vol']);
    })
    .catch(function(error) {
    console.log('Error:', error);
    });


