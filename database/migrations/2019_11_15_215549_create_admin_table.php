<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//  php artisan make:migration create_admins_table / الامر
// استخدام امر  لتجهيز جدول في قاعدة البيانات فارغ واضافة الحقول المطلوبة
// اعطاء امر اضافة البيانات الجداول الى قاعدة البيانات
// php artisan migrate
// مرجع https://laravel.com/docs/5.8/migrations

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('adminID');
            $table->string('admin_email');
            $table->string('password');
            $table->string('admin_fName');
            $table->string('admin_mName');
            $table->string('admin_lName');
            $table->string('adminName');
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
        Schema::dropIfExists('admin');
    }
}
