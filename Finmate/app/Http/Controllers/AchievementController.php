<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::all();
        return view('achievements', compact('achievements'));
    }

    public function receiveAchievementReward($achievementId)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => '로그인 후 이용하세요.'], 403);
        }

        $achievement = Achievement::find($achievementId);
        if (!$achievement) {
            return response()->json(['error' => '업적 정보를 찾을 수 없습니다.'], 404);
        }

        if ($achievement->reward_received) {
            return response()->json(['error' => '이미 보상을 받았습니다.'], 400);
        }

        $user->points += $achievement->points;
        $user->save();
        $achievement->reward_received = true;
        $achievement->save();

        return response()->json(['success' => '포인트가 지급되었습니다.']);
    }

}
