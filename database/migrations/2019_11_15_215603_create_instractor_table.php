<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//  php artisan make:migration create_instractor_table / الامر
// استخدام امر  لتجهيز جدول في قاعدة البيانات فارغ واضافة الحقول المطلوبة
// اعطاء امر اضافة البيانات الجداول الى قاعدة البيانات
// php artisan migrate
// مرجع https://laravel.com/docs/5.8/migrations

class CreateInstractorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instractor', function (Blueprint $table) {
            $table->increments('instractorID');
            $table->string('instractor_email');
            $table->string('password');
            $table->string('instractor_fName');
            $table->string('instractor_mName');
            $table->string('instractor_lName');
            $table->string('instractorName');
            $table->string('instractor_university');
            $table->integer('instractor_status')->nullable();
            $table->integer('instractor_agree_disagree')->default(0);
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
        Schema::dropIfExists('instractor');
    }
}
