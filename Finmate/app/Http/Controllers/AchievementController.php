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

        $userprogress = Auth::user();
        $progress = 0;
        switch ($achievement->id) {
            case 1:
                $progress = ($userprogress->login_count / 10) * 100;
                break;
            case 2:
                $progress = ($userprogress->point_draw_count / 10) * 100;
                break;
            case 3:
                $progress = ($userprogress->item_draw_count / 10) * 100;
                break;
            case 4:
                $progress = ($userprogress->history_check_count / 10) * 100;
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

        // Get achievement points
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
            // Check if an achieve_user entry exists for the user and the achievement
            $achieve_user = AchieveUser::where('userid', $user->userid)
                ->where('achievementsid', $achievement->id)
                ->first();

            // If an entry does not exist, create one
            if (!$achieve_user) {
                $achieve_user = new AchieveUser([
                    'userid' => $user->userid,
                    'achievementsid' => $achievement->id,
                    'reward_received' => '0'
                ]);
                $achieve_user->save();
            }

            $reward_received = $achieve_user->reward_received;

            switch ($achievement->id) {
                case 1:
                    $progress = ($user->login_count / 10) * 100;
                    $isAchieved = $user->login_count >= 10;
                    break;

                case 2:
                    $progress = ($user->point_draw_count / 10) * 100;
                    $isAchieved = $user->point_draw_count >= 10;
                    break;

                case 3:
                    $progress = ($user->item_draw_count / 10) * 100;
                    $isAchieved = $user->item_draw_count >= 10;
                    break;

                case 4:
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
                'reward_received' => $reward_received
            ]);
        }

        return response()->json(['results' => $results]);
    }
}
