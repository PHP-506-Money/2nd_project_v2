<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : ApiController.php
 * History      : v001 0616 EY.Sin new
 *******************************************/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getUserChk($id){

        // ID에 영문과 숫자만 포함되어 있는지 확인
        if (!ctype_alnum($id)) {
            $arr['errorcode'] = "E02";
            $arr['msg'] = "! ID는 영문 대소문자, 숫자로만 구성되어야 합니다.";
            return response()->json($arr, Response::HTTP_OK);
        }

        $user=DB::table('users')->where('userid',$id)->first();
        // user가 없을 경우 성공
        $arr['errorcode']="0";
        $arr['msg']="✓ 사용가능한 아이디 입니다.";
        // 유저가 있을 경우
        if($user){
            $arr['errorcode']="E01";
            $arr['msg'] = "! 이미 가입된 아이디 입니다.";
        }
        // ID 길이 확인
        $id_length = strlen($id);
        if ($id_length < 4 || $id_length > 12) {
            $arr['errorcode']="E02";
            $arr['msg'] = "! ID는 영문 대소문자, 숫자로 4~12글자여야 합니다.";
        }
        return response()->json($arr, Response::HTTP_OK);
    }
}