<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AchieveUser;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::all();
        return view('achievements', compact('achievements'));
    }

    public function receiveAchievementReward(Request $request, $achievementId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => '로그인 후 이용하세요.'], 403);
        }

        $achievement = Achievement::find($achievementId);
        if (!$achievement) {
            return response()->json(['error' => '업적 정보를 찾을 수 없습니다.'], 404);
        }

        $rewardReceived = AchieveUser::where('userid', $user->userid)
            ->where('achievement_id', $achievement->id)
            ->first();

        if ($rewardReceived) {
            return response()->json(['error' => '이미 보상을 받았습니다.'], 400);
        }

        $user->point += $achievement->points;
        $user->save();

        $achieveUser = new AchieveUser();
        $achieveUser->userid = $user->userid;
        $achieveUser->achievement_id = $achievement->id;
        $achieveUser->completed_at = Carbon::now();
        $achieveUser->reward_received = '1';
        $achieveUser->save();

        return response()->json(['success' => '포인트가 지급되었습니다.']);
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
                $achieveUser = AchieveUser::where('userid', $user->userid)
                    ->where('id', $achievement->id)
                    ->first();
                $rewardReceived = $achieveUser && $achieveUser->reward_received == '1';
            }

            array_push($results, [
                'id' => $achievement->id,
                'name' => $achievement->name,
                'progress' => min(100, (int)$progress),
                'is_achieved' => $isAchieved,
                'reward_received' => $rewardReceived
            ]);
        }

        return response()->json(['results' => $results],200,[],JSON_UNESCAPED_UNICODE);
    }



}
