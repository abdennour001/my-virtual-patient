<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionForPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_for_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('answer_of_patient_id');
            $table->timestamps();
            $table->text('question_body');
            $table->boolean('isPrimary');

            $table->index('answer_of_patient_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_for_patients');
    }
}
