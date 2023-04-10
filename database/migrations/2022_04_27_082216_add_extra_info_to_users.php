<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('store_label')->nullable();
            $table->string('icon')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('otp_code')->nullable();
            $table->text('summary')->nullable();
            $table->json('summary_pics')->nullable();
            $table->double('rating')->nullable();
            $table->integer('ratings')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_code')->nullable();
            $table->boolean('merchant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
