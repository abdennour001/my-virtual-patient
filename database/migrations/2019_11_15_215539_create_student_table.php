<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//  php artisan make:migration create_instractor_table / الامر
// استخدام امر  لتجهيز جدول في قاعدة البيانات فارغ واضافة الحقول المطلوبة
// اعطاء امر اضافة البيانات الجداول الى قاعدة البيانات
// php artisan migrate
// مرجع https://laravel.com/docs/5.8/migrations

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studentID');
            $table->string('student_email');
            $table->string('password');
            $table->string('student_fName');
            $table->string('student_mName');
            $table->string('student_lName');
            $table->string('studentName');
            $table->string('student_university');
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
        Schema::dropIfExists('student');
    }
}
