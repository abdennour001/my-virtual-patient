<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('interactive_case_id');
            $table->timestamps();
            $table->enum('gender', array('male', 'female'));
            $table->unsignedSmallInteger('age');
            $table->text('condition');
            $table->text('injury_type');
            $table->text('facial_expression');
            $table->text('nonverbal_expression');
            $table->string('virtual_character');

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
        Schema::dropIfExists('patients');
    }
}
