<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : UserController.php
 * History      : v001 0615 EY.Sin new
 *******************************************/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    function login() {
        return view('login');
    }

    function loginpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'id'    => 'regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만
            ,'password'  => 'regex:/^(?=.*[a-zA-Z])(?=.*[~#%*!@^])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
        ]);

        // 유저정보 습득
        $user = User::where('userid', $req->id)->first();
        if(!$user || !(Hash::check($req->password, $user->userpw))) {
            $error = '<div class="error">아이디와 비밀번호를 다시 확인해주세요.</div>';
            return redirect()->back()->with('error', $error);
        }

        // 유저 인증작업
        Auth::login($user); // 테스트시 비활성화 하고 테스트하면 됨.
        if(Auth::check()) {
            session($user->only('id')); // 세션에 인증된 회원 pk 등록
            return redirect()->intended(url('/assets' . '/' . auth()->user()->userid));
        } else {
            $error = '인증작업 에러';
            return redirect()->back()->with('error', $error);
        }
    }

    function registration() {
        return view('registration');
    }

    function registrationpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'name'          => 'regex:/^[a-zA-Z가-힣]{2,20}$/' // regex:정규식. 한글, 영어만 글자 수 2~20
            ,'id'           => 'unique:users,userid|regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만. DB users 테이블의 userid가 있는지 여부 체크
            ,'password'     => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~#%*!@^])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
            ,'email'        => 'email:rfc,dns|unique:users,useremail' // 이메일 유효성체크
            ,'phone'        => 'regex:/^01[016789]-?[^0][0-9]{3,4}-?[0-9]{4}$/' // 휴대폰번호 유효성체크
            ,'moffintype'   => 'required' // 모핀이 체크여부 확인
        ]);

        // $data['name'] = $req->input('name'); // 밑의 방법과 동일함.
        $data['username'] = $req->name;
        $data['userid'] = $req->id;
        $data['userpw'] = Hash::make($req->password);
        $data['useremail'] = $req->email;
        $data['phone'] = $req->phone;
        $data['moffintype'] = $req->moffintype;
        

        $user = User::create($data); // insert. create ORM 모델
        if(!$user) {
            $error = '시스템 에러가 발생하여, 회원가입에 실패했습니다.<br>잠시 후에 다시 회원가입을 시도해 주십시오.';
        return redirect()
            ->route('users.registration')
            ->with('error', $error);
        }

        // 회원가입 완료 로그인 페이지로 이동
        return redirect()
            ->route('users.login')
            ->with('success', '회원가입을 완료 했습니다.<br>가입하신 아이디와 비밀번호로 로그인 해주십시오.');
    }

    // 로그아웃
    function logout() {
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('users.login');
    }

    function findid() {
        return view('findid');
    }

    function findpw() {
        return view('findpw');
    }

    function myinfo() {
        $id = auth()->user()->userno; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $result = User::select(['username', 'moffintype', 'moffinname'])
                        ->where('userno', $id)
                        ->get();
        return view('myinfo')->with('data', $result);
    }

    function myinfopost(Request $req) {
        $id = auth()->user()->userno;

        // 유효성 검사 방법 1
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'moffinname'  => 'regex:/^[a-zA-Z가-힣]{1,20}$/' // regex:정규식. 한글, 영어만 글자 수 1~20
        ]);

        $result = User::find($id);
        if (!$result) {
            // 사용자를 찾지 못한 경우에 대한 처리
            return redirect()->back()->withErrors(['message' => '사용자를 찾을 수 없습니다.']);
        }    

        $result->moffinname = $req->moffinname;
        $result->save();

        return redirect()->route('users.myinfo');
    }

    function modify() {
        $id = auth()->user()->userno; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $result = User::select(['username', 'userid', 'userpw', 'useremail', 'phone'])
                        ->where('userno', $id)
                        ->get();
        return view('modify')->with('data', $result);
    }

    function modifypost(Request $req) {
        $id = auth()->user()->userno;

        // 유효성 검사 방법 1
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'name'          => 'regex:/^[a-zA-Z가-힣]{2,20}$/' // regex:정규식. 한글, 영어만 글자 수 2~20
            ,'id'           => 'regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만.
            ,'password'     => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~#%*!@^])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
            ,'email'        => 'email:rfc,dns' // 이메일 유효성체크
            ,'phone'        => 'regex:/^01[016789]-?[^0][0-9]{3,4}-?[0-9]{4}$/' // 휴대폰번호 유효성체크
        ]);

        $result = User::find($id);
        if (!$result) {
            // 사용자를 찾지 못한 경우에 대한 처리
            return redirect()->back()->withErrors(['message' => '사용자를 찾을 수 없습니다.']);
        }    

        $data['userpw'] = Hash::make($req->password);
        $data['useremail'] = $req->email;
        $data['phone'] = $req->phone;

        $result->update($data);

        return redirect()->route('users.myinfo');
    }

    function withdraw() {
        $id = session('id');
        $result = User::destroy($id); // destroy 에러 났을 때 에러 핸들링 써서 예외 처리 하기
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('users.login');
    }
}