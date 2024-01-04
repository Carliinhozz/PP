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
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('name');
            $table->string('institucional_code');
            $table->boolean('disponibility')->default(1);
            $table->timestamps();
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->references('id')->on('instrument_models');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruments');
    }
};