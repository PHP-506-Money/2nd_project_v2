<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('userid',12)->comment('유저ID');
            $table->string('token')->unique()->comment('토큰');
            $table->dateTime('expire_at')->nullable()->comment('토큰의 유효기간');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE user_tokens COMMENT '유저 토큰'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tokens');
    }
};
