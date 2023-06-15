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
            $table->string('userpw',100);
            $table->string('useremail',50)->unique();
            $table->string('phone',20);
            $table->timestamps();
            $table->softDeletes();
            $table->char('moffintype',1);
            $table->integer('point')->default(100);
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
