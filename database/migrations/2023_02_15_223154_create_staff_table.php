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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('username')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('staff_type')->nullable();
            $table->string('specialty')->nullable();
            $table->string('age');
            $table->string('rate')->default(0);
            $table->string('current_hospital');
            $table->string('graduation_year');
            $table->string('experience_years');
            $table->string('experiences');
            $table->string('about');
            $table->string('salary');
            $table->string('certificate_count');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
};
