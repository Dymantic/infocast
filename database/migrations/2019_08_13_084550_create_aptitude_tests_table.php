<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAptitudeTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aptitude_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidate_id')->unsigned();
            $table->date('tested_on');
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
        Schema::dropIfExists('aptitude_tests');
    }
}
