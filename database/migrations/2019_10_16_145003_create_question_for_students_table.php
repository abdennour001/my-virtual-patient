<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionForStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_for_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('interactive_case_id');
            $table->timestamps();
            $table->text('question_body');

            $table->index('interactive_case_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_for_students');
    }
}
