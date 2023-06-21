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
        Schema::create('goals', function (Blueprint $table) {
            $table->increments('goalno');
            $table->integer('userno');
            $table->string('userid',12);
            $table->string('title', 15);
            $table->integer('amount');
            $table->date('startperiod');
            $table->date('endperiod');
            $table->timestamps();
            $table->softDeletes();
            $table->date('completed_at')->nullable();
            $table->char('iscom', 1)->default('0');
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
