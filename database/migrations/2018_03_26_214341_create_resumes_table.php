<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('patronymic', 100);
            $table->string('email', 100);
            $table->integer('age');
            $table->string('post', 100);
            $table->string('city', 100);
            $table->integer('category_id');
            $table->string('file', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('employment_type', 80);
            $table->integer('phone');
            $table->integer('salary')->nullable();
            $table->string('education', 255);
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
        Schema::dropIfExists('resumes');
    }
}
