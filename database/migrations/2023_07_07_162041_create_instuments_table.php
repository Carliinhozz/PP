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
        Schema::create('instuments', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('control_code');
            $table->timestamps();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('intrument_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instuments');
    }
};
