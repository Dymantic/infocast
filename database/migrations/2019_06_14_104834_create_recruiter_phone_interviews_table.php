<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruiterPhoneInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruiter_phone_interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidate_id')->unsigned();
            $table->date('interviewed_on');
            $table->integer('marked_by')->unsigned();
            $table->boolean('skipped')->default(0);
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
        Schema::dropIfExists('recruiter_phone_interviews');
    }
}
