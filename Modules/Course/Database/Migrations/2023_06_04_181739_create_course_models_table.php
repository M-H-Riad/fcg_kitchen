<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_models', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->string('name');
            $table->string('instructor')->nullable();
            $table->string('duration')->nullable();
            $table->string('total_class')->nullable();
            $table->string('details')->nullable();
            $table->string('url');
            $table->string('status')->nullable()->default(1);
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
        Schema::dropIfExists('course_models');
    }
}
