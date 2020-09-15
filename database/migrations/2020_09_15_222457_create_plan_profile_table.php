<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_profile', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('plan_id')->unsigned();
            $table->bigInteger('profile_id')->unsigned();

            $table->foreign('plan_id')
                        ->references('id')
                        ->on('plans')
                        ->onDelete('cascade');
            $table->foreign('profile_id')
                        ->references('id')
                        ->on('profiles')
                        ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_profile');
    }
}
