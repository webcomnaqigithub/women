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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('sender_id')->nullable();
            $table->string('receiver_id')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_image');
            $table->string('content');
            $table->string('product_name');
            $table->string('path');
            $table->integer('status')->default(1);
            $table->boolean('viewed')->default(0);
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
        Schema::dropIfExists('notifications');
    }
};
