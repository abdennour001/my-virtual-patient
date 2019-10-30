<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerOfPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_of_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('interactive_case_id');
            $table->timestamps();
            $table->text('answer_body');
            $table->string('voice_record')->nullable();

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
        Schema::dropIfExists('answer_of_patients');
    }
}
