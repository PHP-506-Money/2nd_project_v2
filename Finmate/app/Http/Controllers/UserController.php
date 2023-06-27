<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : UserController.php
 * History      : v001 0615 EY.Sin new
 *******************************************/

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AchieveUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
            $error = '<div class="error">! 아이디와 비밀번호를 다시 확인해주세요.</div>';
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
            ,'email'        => 'email:rfc,dns,filter|unique:users,useremail' // 이메일 유효성체크
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
            $error = '<div class="error">! 시스템 에러가 발생하여, 회원가입에 실패했습니다.<br>잠시 후에 다시 회원가입을 시도해 주십시오.</div>';
        return redirect()
            ->route('users.registration')
            ->with('error', $error);
        }

        // 회원가입 완료 로그인 페이지로 이동
        $success = '<div class="success">✓ Success!<br>회원가입을 완료 했습니다.<br>가입하신 아이디와 비밀번호로 로그인 해주십시오.</div>';
        return redirect()
            ->route('users.login')
            ->with('success', $success);
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

    function findidpost(Request $req) {
         //유효성 체크
         $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'name'          => 'regex:/^[a-zA-Z가-힣]{2,20}$/' // regex:정규식. 한글, 영어만 글자 수 2~20
            ,'email'        => 'email:rfc,dns,filter' // 이메일 유효성체크
        ]);

        // 폼 데이터에서 이름, 이메일 주소 추출
        $name = $req->input('name');
        $email = $req->input('email');

        // 데이터베이스에서 이메일에 해당하는 사용자 조회
        $user = User::where('username', $name)
        ->where('useremail', $email)
        ->first();

        return view('foundid', ['user'=>$user]);
    }

    function findpw() {
        return view('findpw');
    }

    function findpwpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'id'           => 'regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만. 
           ,'email'        => 'email:rfc,dns,filter' // 이메일 유효성체크
        ]);

       // 폼 데이터에서 이름, 이메일 주소 추출
        $id = $req->input('id');
        $email = $req->input('email');

       // 데이터베이스에서 이메일에 해당하는 사용자 조회
        $user = DB::table('users')
        ->where('userid', $id)
        ->where('useremail', $email)
        ->first();
        $userid = $user->userid;
        return redirect()->route('users.updatepw',['userid' => $userid]);
    }

    function updatepw(Request $req, User $user) { // 사용자 객체를 주입받음
        
        return view('updatepw', compact('user'))->with('data',$user); // user 변수를 compact 함수로 전달
    }

    function updatepwpost(Request $req) {
        Log::debug('유효성체크');
        // 유효성 체크
        $req->validate([
            'password' => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~#%*!@^])(?=.*[0-9]).{8,12}$/'
        ]);
        
        $userid = $req->id;
        $result = User::where('userid', $userid)->first();
    
        $data = ['userpw' => Hash::make($req->password)];
    
        $result->update($data);
    
        // 비밀번호 변경 완료. 로그인 페이지로 이동
        $success = '<div class="success">✓ Success!<br>비밀번호 변경을 완료 했습니다.<br>변경한 비밀번호로 로그인 해주십시오.</div>';
        return redirect()
            ->route('users.login')
            ->with('success', $success);
    }
    
    function profile($id) {
        // $id = auth()->user()->userid; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $result = User::select(['username', 'moffintype', 'moffinname'])
                        ->where('userid', $id)
                        ->get();
        $item_name = DB::table('iteminfos AS info')
        ->select('info.itemname')
        ->join('items AS tem', 'info.itemno', '=', 'tem.itemno')
        ->where('tem.userid', $id)
        ->orderBy('info.itemno', 'ASC')
        ->pluck('itemname')//아이템 이름반환(컬렉션 객체)
        ->toArray();// 컬렉션 객체를 다시 배열로 바꿔줌

        $itemonly = array_unique($item_name);// 유저가 가진 아이템이 중복값이 많아서 출력할때 중복값 제거하기위해서 unique써서 $itemonly에 담아줌
                
        return view('profile')->with('data', $result)->with('itemname', $itemonly);
    }

    function profilepost(Request $req) {
        $id = auth()->user()->userid;

        // 유효성 검사 방법 1
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'moffinname'  => 'regex:/^[a-zA-Z가-힣]{1,20}$/' // regex:정규식. 한글, 영어만 글자 수 1~20
        ]);

        $result = User::where('userid', $id)->first();
        if (!$result) {
            // 사용자를 찾지 못한 경우에 대한 처리
            return redirect()->back()->withErrors(['message' => '사용자를 찾을 수 없습니다.']);
        }    

        $result->moffinname = $req->moffinname;
        $result->save();

        $success = '<div class="success">✓ Success!<br>모핀이명 변경을 완료 하였습니다.</div>';
        return redirect()
        ->route('users.profile')
        ->with('success', $success);
    }

    function modify() {
        $id = auth()->user()->userid; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $result = User::select(['username', 'userid', 'userpw', 'useremail', 'phone'])
                        ->where('userid', $id)
                        ->get();
        return view('modify')->with('data', $result);
    }

    function modifypost(Request $req) {
        $id = auth()->user()->userid;

        // 유효성 검사 방법 1
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'name'          => 'regex:/^[a-zA-Z가-힣]{2,20}$/' // regex:정규식. 한글, 영어만 글자 수 2~20
            ,'id'           => 'regex:/^[a-zA-Z0-9]{4,12}$/' //4~12자 영문, 숫자만.
            ,'password'     => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~#%*!@^])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
            ,'email'        => 'email:rfc,dns,filter' // 이메일 유효성체크
            ,'phone'        => 'regex:/^01[016789]-?[^0][0-9]{3,4}-?[0-9]{4}$/' // 휴대폰번호 유효성체크
        ]);

        $result = User::where('userid', $id)->first();
        if (!$result) {
            // 사용자를 찾지 못한 경우에 대한 처리
            return redirect()->back()->withErrors(['message' => '사용자를 찾을 수 없습니다.']);
        }    

        $data['userpw'] = Hash::make($req->password);
        $data['useremail'] = $req->email;
        $data['phone'] = $req->phone;

        $result->update($data);

        // 회원정보 변경 완료. 수정 페이지 리다이렉트
        $success = '<div class="success">✓ Success!<br>회원정보 변경을 완료 하였습니다.</div>';
        return redirect()
        ->route('users.modify')
        ->with('success', $success);
    }

    // 회원탈퇴 기능: softdeletes();를 사용하여 migration을 하였으므로, 로그인시 자동으로 탈퇴한 회원은 로그인 불가능하게 막아줌.
    function withdraw() {
        $id = auth()->user()->userid;
        $result = User::destroy($id); // destroy 에러 났을 때 에러 핸들링 써서 예외 처리 하기
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃

        return redirect()->route('users.login');
    }

}
