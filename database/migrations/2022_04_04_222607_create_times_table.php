<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->time('time')->nullable();
            $table->timestamps();
            $table->time('stop_time')->nullable();
            $table->time('start_time')->nullable();
            $table->time('rest_start')->nullable();
            $table->time('rest_stop')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('times');
        $table->dropSoftDeletes();
    }
}
