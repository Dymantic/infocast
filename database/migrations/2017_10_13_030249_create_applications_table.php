<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('posting_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact_method')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('prev_company')->nullable();
            $table->string('prev_position')->nullable();
            $table->string('university')->nullable();
            $table->text('qualifications')->nullable();
            $table->text('skills')->nullable();
            $table->string('english_ability')->nullable();
            $table->string('mandarin_ability')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('avatar')->nullable();
            $table->unsignedInteger('cover_letter')->nullable();
            $table->unsignedInteger('cv')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
