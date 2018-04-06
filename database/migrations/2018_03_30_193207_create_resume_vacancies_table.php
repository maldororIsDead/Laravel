<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vacancy_id')->nullable();
            $table->integer('resume_id')->nullable();
            $table->timestamps();
            $table->unique(['vacancy_id', 'resume_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_vacancies');
    }
}
