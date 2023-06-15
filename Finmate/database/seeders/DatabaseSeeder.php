<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $faker = Faker::create();

        $originalData = [
            'accounts' => [
                [
                    'name' => '토스뱅크',
                    'balance' => '90895',
                    'transactions' => [
                        [
                            'type' => '체크카드 결제',
                            'merchant' => '토스뱅크',
                            'payee' => '버터비',
                            'amount' => '-10500',
                            'category' => '식비',
                            'time' => '2023년06월14일14:05'
                        ],
                        [
                            'type' => '카드 캐시백',
                            'merchant' => '카드 캐시백',
                            'payee' => '토스뱅크',
                            'amount' => '+100',
                            'category' => '금융',
                            'time' => '2023년06월14일13:26'
                        ]
                    ]
                ],
                [
                    'name' => '신한은행',
                    'balance' => '600514',
                    'transactions' => [
                        [
                            'type' => '체크카드 결제',
                            'merchant' => '오늘하루체크카드',
                            'payee' => '배달의민족',
                            'amount' => '-27500',
                            'category' => '식비',
                            'time' => '2023년06월14일20:01'
                        ],
                        [
                            'type' => '이체',
                            'merchant' => '토스뱅크',
                            'payee' => '신한은행',
                            'amount' => '+500000',
                            'category' => '금융',
                            'time' => '2023년06월12일10:18'
                        ]
                    ]
                ]
            ]
        ];

        for ($i = 0; $i < 1000; $i++) {
            $newData = $originalData;

            // 계좌 이름 변경
            $newData['accounts'][0]['name'] = '은행' . ($i + 1);

            // 잔액 변경
            $newData['accounts'][0]['balance'] = rand(1000, 100000);

            // 거래 내역 추가
            $newTransaction = [
                'type' => '체크카드 결제',
                'merchant' => '가맹점' . ($i + 1),
                'payee' => '수취인' . ($i + 1),
                'amount' => '-' . rand(100, 10000),
                'category' => '기타',
                'time' => date('Y년m월d일 H:i', strtotime('-' . $i . ' days'))
            ];

            $newData['accounts'][0]['transactions'][] = $newTransaction;

            $data[] = $newData;
        }
    }
    
}
