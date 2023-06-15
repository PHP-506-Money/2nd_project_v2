<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function GetJsonData()
    {
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

        $data = [];

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
        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('dummy_data.json', $data);
    }

    public function getUserAccounts()
    {
        $user = auth()->user(); // 인증된 사용자 정보 가져오기

        $userAccounts = $user->accounts()->with('transactions')->get(); // 사용자의 계좌와 연관된 거래 내역 가져오기

        $data = [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'accounts' => [],
        ];

        foreach ($userAccounts as $account) {
            $transactionsData = [];

            foreach ($account->transactions as $transaction) {
                $transactionData = [
                    'id' => $transaction->id,
                    'merchant' => $transaction->merchant,
                    'payee' => $transaction->payee,
                    'amount' => $transaction->amount,
                    'category' => $transaction->category,
                    'time' => $transaction->created_at,
                ];

                $transactionsData[] = $transactionData;
            }

            $accountData = [
                'id' => $account->id,
                'balance' => $account->balance,
                'transactions' => $transactionsData,
            ];

            $data['accounts'][] = $accountData;
        }

        return response()->json($data);
    }

}
