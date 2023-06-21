<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Achievement::create([
            'name' => '로그인 10회',
            'description' => '로그인을 10회 하면 이 업적을 달성할 수 있습니다.',
            'points' => 10,
        ]);


        Achievement::create([
            'name' => '포인트 뽑기',
            'description' => '포인트 뽑기를 10회 하면 이 업적을 달성할 수 있습니다.',
            'points' => 100,
        ]);

        Achievement::create([
            'name' => '아이템 뽑기',
            'description' => '아이템 뽑기를 10회 하면 이 업적을 달성할 수 있습니다.',
            'points' => 200,
        ]);

        Achievement::create([
            'name' => '내역 조회',
            'description' => '내역을 10회 조회하면 이 업적을 달성할 수 있습니다.',
            'points' => 300,
        ]);

        Achievement::create([
            'name' => '지난달에 비해 입금내역 증가',
            'description' => '지난달에 비해 입금내역이 증가하면 이 업적을 달성할 수 있습니다.',
            'points' => 500,
        ]);

        Achievement::create([
            'name' => '지난달에 비해 지출내역 감소',
            'description' => '지난달에 비해 지출내역이 감소하면 이 업적을 달성할 수 있습니다.',
            'points' => 1000,
        ]);

    }
}
