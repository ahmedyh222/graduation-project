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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('feedback_from');
            $table->unsignedBigInteger('feedback_to');
            $table->foreign('feedback_from')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('feedback_to')->references('id')->on('doctors')->cascadeOnDelete();
            $table->double('rate')->nullable();
            $table->text('feedback');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
