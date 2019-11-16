<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section', function (Blueprint $table) {
            $table->increments('sectionID');
            $table->unsignedSmallInteger('section_number');
            $table->string('section_name');
            $table->string('path_excel_sheet')->nullable();

            $table->string('studentIDs');
            $table->index('instructor_section_id');
            $table->integer('instructor_section_id')->unsigned()->nullable();
            $table->foreign('instructor_section_id')->references('instractorID')->on('instractor')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('sections');
    }
}
