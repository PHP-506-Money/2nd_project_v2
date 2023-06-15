<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('userno');
            $table->string('username',20);
            $table->string('userid',12)->unique();
            $table->string('userpw',60);
            $table->string('useremail',50)->unique();
            $table->string('phone',20);
            $table->char('moffintype',1);
            $table->string('moffinname',20)->default('모핀이');
            $table->integer('point')->default(100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
