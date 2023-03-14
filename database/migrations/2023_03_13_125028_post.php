<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('post_title');
            $table->string('post_content');
            $table->string('image_name');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->dateTime('post_created')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
