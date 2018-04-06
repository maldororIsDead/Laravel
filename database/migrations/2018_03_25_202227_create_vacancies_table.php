<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->string('company', 100)->nullable();
            $table->string('contact_name', 100)->nullable();
            $table->integer('category_id');
            $table->integer('salary');
            $table->integer('phone');
            $table->string('file', 100)->nullable();
            $table->string('city', 40);
            $table->string('employment_type', 80);
            $table->string('requirements', 80);
            $table->text('description');
            $table->integer('user_id');
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
        Schema::dropIfExists('vacancies');
    }
}
