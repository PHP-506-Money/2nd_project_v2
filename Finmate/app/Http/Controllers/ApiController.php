<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getUserChk($id){

        $user=DB::table('users')->where('userid',$id)->first();
        // user가 없을 경우 성공
        $arr['errorcode']="0";
        $arr['msg']="사용가능한 아이디 입니다.";
        // 유저가 있을 경우
        if($user){
            $arr['errorcode']="E01";
            $arr['msg'] = "이미 가입된 아이디 입니다.";
        }
        return response()->json($arr, Response::HTTP_OK);
    }
}