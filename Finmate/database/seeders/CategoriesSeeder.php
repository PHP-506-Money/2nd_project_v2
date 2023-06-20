<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['no'=>'0' , 'name'=>'외식'],
            ['no'=>'1' , 'name'=>'편의점/마트'],
            ['no'=>'2' , 'name'=>'유흥'],
            ['no'=>'3' , 'name'=>'쇼핑'],
            ['no'=>'4' , 'name'=>'주거생활'],
            ['no'=>'5' , 'name'=>'건강관리'],
            ['no'=>'6' , 'name'=>'교통'],
            ['no'=>'7' , 'name'=>'통신'],
            ['no'=>'8' , 'name'=>'저축'],
            ['no'=>'9' , 'name'=>'기타']
        ]);
    }
}
