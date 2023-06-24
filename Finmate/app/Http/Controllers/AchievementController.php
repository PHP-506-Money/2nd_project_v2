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
    public function index()
    {
        $achievements = Achievement::all();
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

        $achieve_users = DB::table('achieve_users')
            ->where('userid', $user)
            ->where('achievementsid', $achievement->id)
            ->first();

        // $achieve_users 변수가 null이면 reward_received를 0으로 설정합니다.
        if (!$achieve_users) {
            $rewardReceived = '0';
        } else {
            $rewardReceived = $achieve_users->reward_received;
        }

        if ($rewardReceived == '1') {
            return response()->json(['error' => '이미 보상을 받았습니다.'], 400);
        }

        // $user->point += $achievement->points;
        // User::where($user)->update();

        $points = DB::table('achievements')->select('points')->first();
        $achieve_users = DB::table('achieve_users')->where('userid', $user)->pluck('userid')->first();

        User::where('userid', $achieve_users)
            ->increment('point', $points->points);

        if (!$achieve_users) {
            $achieve_users = new AchieveUser();
            $achieve_users->userid = $user;
            $achieve_users->achievementsid = $achievement->id;
            User::where('userid', $achieve_users)
                ->increment('point', $points->points);
        }

        $achieve_user = AchieveUser::where('userid', $achieve_users)->first();

        if (!$achieve_user) {
            $achieve_user = new AchieveUser();
            $achieve_user->userid = $achieve_users->userid;
            $achieve_user->achievementsid = $achievement->id;
        }

        $achieve_user->completed_at = Carbon::now();
        $achieve_user->reward_received = '1';
        $achieve_user->save();


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
            $rewardReceived = '0';

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
                $achieve_users = DB::table('achieve_users')
                    ->where('userid', '=', $user->userid)
                    ->where('id', '=', $achievement->id)
                    ->first();
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
