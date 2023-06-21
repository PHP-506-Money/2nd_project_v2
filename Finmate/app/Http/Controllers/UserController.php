<?php
/******************************************
 * Project Name : Finmate
 * Directory    : Controllers
 * File Name    : UserController.php
 * History      : v001 0615 EY.Sin new
 *******************************************/

namespace App\Http\Controllers;

use App\Models\Achievement;
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
            $error = '<div class="error">시스템 에러가 발생하여, 회원가입에 실패했습니다.<br>잠시 후에 다시 회원가입을 시도해 주십시오.</div>';
        return redirect()
            ->route('users.registration')
            ->with('error', $error);
        }

        // 회원가입 완료 로그인 페이지로 이동
        $success = '<div class="success">회원가입을 완료 했습니다.<br>가입하신 아이디와 비밀번호로 로그인 해주십시오.</div>';
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
            ,'email'        => 'email:rfc,dns' // 이메일 유효성체크
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
           ,'email'        => 'email:rfc,dns' // 이메일 유효성체크
        ]);

       // 폼 데이터에서 이름, 이메일 주소 추출
        $id = $req->input('id');
        $email = $req->input('email');

       // 데이터베이스에서 이메일에 해당하는 사용자 조회
        $user = User::where('userid', $id)
        ->where('useremail', $email)
        ->first();

    return view('foundpw', ['user'=>$user]);
    }

    function foundpwpost(Request $req) {
        //유효성 체크
        $req->validate([ // validate는 자동으로 리다이렉트 해줌.
            'password'     => 'same:passwordchk|regex:/^(?=.*[a-zA-Z])(?=.*[~#%*!@^])(?=.*[0-9]).{8,12}$/' //8~12자 영문 숫자 특수문자(~#%*!@^) 최소 하나씩 무조건 포함
        ]);

        $data['userpw'] = Hash::make($req->password);

        return redirect()->route('users.login');
    }

    function myinfo() {
        $id = auth()->user()->userid; // 현재 로그인한 사용자의 ID를 가져옵니다.
        $result = User::select(['username', 'moffintype', 'moffinname'])
                        ->where('userid', $id)
                        ->get();
        return view('myinfo')->with('data', $result);
    }

    function myinfopost(Request $req) {
        $id = auth()->user()->userid;

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

    // 회원탈퇴 기능: softdeletes();를 사용하여 migration을 하였으므로, 로그인시 자동으로 탈퇴한 회원은 로그인 불가능하게 막아줌.
    function withdraw() {
        $id = auth()->user()->userid;
        $result = User::destroy($id); // destroy 에러 났을 때 에러 핸들링 써서 예외 처리 하기
        Session::flush(); // 세션 파기
        Auth::logout(); // 로그아웃
        return redirect()->route('users.login');
    }


    public function getAchievements($userid)
    {
        $user = User::find($userid);
        if (!$user) {
            return response()->json(['error' => '유저를 찾을 수 없습니다.'], 404);
        }

        $achievements = $user->achievements;
        return response()->json(['achievements' => $achievements]);
    }

    public function checkAchievements()
    {
        $user = Auth::user();
        $achievements = Achievement::all();

        $results = [];
        foreach ($achievements as $achievement) {
            $progress = 0;
            $isAchieved = false;
            $rewardReceived = false;

            switch ($achievement->name) {
                case '로그인 10회':
                    $progress = ($user->login_count / 10) * 100;
                    $isAchieved = $user->login_count >= 10;
                    break;

                case '포인트 뽑기':
                    $progress = ($user->point_draw_count / 10) * 100;
                    $isAchieved = $user->point_draw_count >= 10;
                    break;

                case '아이템 뽑기':
                    $progress = ($user->item_draw_count / 10) * 100;
                    $isAchieved = $user->item_draw_count >= 10;
                    break;

                case '내역 조회':
                    $progress = ($user->history_check_count / 10) * 100;
                    $isAchieved = $user->history_check_count >= 10;
                    break;
            }

            if ($isAchieved) {
                // Reward received logic should be implemented here
                // If the reward has not been received, you should set $rewardReceived = false; instead
                $rewardReceived = true;
            }

            array_push($results, [
                'id' => $achievement->id,
                'name' => $achievement->name,
                'progress' => min(100, (int)$progress),
                'is_achieved' => $isAchieved,
                'reward_received' => $rewardReceived
            ]);
        }

        return response()->json(['results' => $results]);
    }



}