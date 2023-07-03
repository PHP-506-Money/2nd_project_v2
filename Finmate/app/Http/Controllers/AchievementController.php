<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\achieve_users;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Models\AchieveUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AchievementController extends Controller
{

    public function initializeAchievements() //이니셜 업적 삽입 함수
    {
        $user = Auth::user(); //유저 가져오기
        $achievements = Achievement::all(); // 업적 가져오기
        $achievementCount = $achievements->count(); // 업적 갯수 체크

        for ($i=1; $i <= $achievementCount ; $i++) { // 업적 갯수 만큼 업적유저 디비쪽에 유저아이디 삽입
            $achieve_user = AchieveUser::where('userid', $user->userid)
                ->where('achievementsid', $i)
                ->first(); 

            // 업적유저쪽에 유저 아이디가 없는 경우 생성
            if (!$achieve_user) {
                $achieve_user = new AchieveUser();
                $achieve_user->userid = $user->userid;
                $achieve_user->achievementsid = $i;
                $achieve_user->reward_received = 0;
                $achieve_user->save();
            }
        }
    }

    public function index()
    {
        $achievements = Achievement::all();
        $user = Auth::user();
        // 유저가 이미 업적 페이지를 방문 한 적이 있는지 체크
        $hasInitializedAchievements = AchieveUser::where('userid', $user->userid)->exists();

        // 업적 페이지 최조 조회 체크해서 이니셜 업적 함수를 불러옴
        if (!$hasInitializedAchievements) {
            $this->initializeAchievements(); 
        }

        $this->checkAchievements(); //업적확인 함수 불러오기

        return view('achievements', compact('achievements'));
    }

    public function receiveAchievementReward(Request $request, $achievementId)
    {
        if (!auth()->check()) {
            return response()->json(['error' => '로그인 후 이용하세요.'], 403);
        }

        $user = auth()->user()->userid;

        if (!$user) {
            return response()->json(['error' => '유저 정보를 찾을 수 없습니다.'], 404);
        }

        $achievement = Achievement::find($achievementId);

        if (!$achievement) {
            return response()->json(['error' => '업적 정보를 찾을 수 없습니다.'], 404);
        }

        $userprogress = Auth::user();
        $progress = 0;
        switch ($achievement->id) { //업적 아이디 불러와서 카운트랑 업적 요구사항으로 프로그래스 확인
            case 1:
                $progress = ($userprogress->login_count / $achievement->requires) * 100;
                break;
            case 2:
                $progress = ($userprogress->point_draw_count / $achievement->requires) * 100;
                break;
            case 3:
                $progress = ($userprogress->item_draw_count / $achievement->requires) * 100;
                break;
            case 4:
                $progress = ($userprogress->history_check_count / $achievement->requires) * 100;
                break;
        }

        if ($progress < 100) {
            return response()->json(['error' => '업적이 완료되지 않았습니다.'], 400);
        }



        $achieve_users = DB::table('achieve_users')
            ->where('userid', $user)
            ->where('achievementsid', $achievement->id)
            ->first();

        if (!$achieve_users) {
            $rewardReceived = '0';
        } else {
            $rewardReceived = $achieve_users->reward_received;
        }

        if ($rewardReceived == '1') {
            return response()->json(['error' => '이미 보상을 받았습니다.'], 400);
        }

        // 업적 포인트 가져오기
        $points = $achievement->points;

        // Check if the user has an achievements record
        $achieve_user = AchieveUser::where('userid', $user)
            ->where('achievementsid', $achievement->id)
            ->first();

        if (!$achieve_user) {
            $achieve_user = new AchieveUser();
            $achieve_user->userid = $user;
            $achieve_user->achievementsid = $achievement->id;
        }

        $achieve_user->completed_at = Carbon::now();
        $achieve_user->reward_received = '1';
        $achieve_user->save();

        // Increase points after updating the AchieveUser entry
        User::where('userid', $user)
            ->increment('point', $points);

        return response()->json(['success' => '포인트가 지급되었습니다.']);
    }



    public function getAchievements($userid)
    {
        $user = User::where('userid', $userid)->first();
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
            $reward_received = 0;

            switch ($achievement->id) {
                case 1:
                    $progress = ($user->login_count / 10) * 100;
                    $isAchieved = $user->login_count >= $achievement->requires;
                    break;

                case 2:
                    $progress = ($user->point_draw_count / 10) * 100;
                    $isAchieved = $user->point_draw_count >= $achievement->requires;
                    break;

                case 3:
                    $progress = ($user->item_draw_count / 10) * 100;
                    $isAchieved = $user->item_draw_count >= $achievement->requires;
                    break;

                case 4:
                    $progress = ($user->history_check_count / 10) * 100;
                    $isAchieved = $user->history_check_count >= $achievement->requires;
                    break;
            }

            if ($isAchieved) {
                $achieve_user = AchieveUser::where('userid', $user->userid)
                ->where('achievementsid', $achievement->id)
                ->first();
                $reward_received = $achieve_user->reward_received;
                // If an entry does not exist, create one
                if (!$achieve_user) {
                    $achieve_user = new AchieveUser([
                        'userid' => $user->userid,
                        'achievementsid' => $achievement->id,
                        'reward_received' => $reward_received
                    ]);
                    $achieve_user->save();
                }
            }


            array_push($results, [
                'id' => $achievement->id,
                'name' => $achievement->name,
                'progress' => min(100, (int)$progress),
                'is_achieved' => $isAchieved,
                'reward_received' => $reward_received
            ]);
        }

        return response()->json(['results' => $results]);
    }
}
