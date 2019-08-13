<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('candidate_id')->unsigned();
            $table->date('checked_on');
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
        Schema::dropIfExists('reference_checks');
    }
}
