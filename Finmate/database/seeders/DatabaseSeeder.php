<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\AssetSeeder;
use Database\Seeders\TransactionSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AssetSeeder::class,
            TransactionSeeder::class
        ]);
    }
}

