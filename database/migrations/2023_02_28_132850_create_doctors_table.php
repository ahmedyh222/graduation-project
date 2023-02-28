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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('staff_type');
            $table->string('specialty');
            $table->string('num_rate')->nullable()->default(0);
            $table->string('age')->nullable();;
            $table->string('rate')->default(0)->nullable();;
            $table->string('current_hospital')->nullable();;
            $table->string('graduation_year')->nullable();;
            $table->string('experience_years')->nullable();;
            $table->string('experiences')->nullable();;
            $table->string('about')->nullable();;
            $table->string('salary')->nullable();;
            $table->string('certificate_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
