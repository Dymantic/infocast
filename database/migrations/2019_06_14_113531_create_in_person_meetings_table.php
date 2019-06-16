<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInPersonMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_person_meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidate_id')->unsigned();
            $table->date('met_on');
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
        Schema::dropIfExists('in_person_meetings');
    }
}
