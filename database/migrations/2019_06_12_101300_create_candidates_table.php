<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('application_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('position')->nullable();
            $table->integer('cover_letter')->unsigned()->nullable();
            $table->integer('cv')->unsigned()->nullable();
            $table->date('terminated_on')->nullable();
            $table->string('terminated_by')->nullable();
            $table->string('terminated_reason')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('finalised')->default(0);
            $table->date('accepted_on')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
