<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instrument_models', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->timestamps();
        });
        DB::table('instrument_models')->insert([
            ['id'=>1,'model' => 'Sopro',],
            ['id'=>2,'model' => 'Corda', ],
            ['id'=>3,'model' => 'Percussão',],
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrument_models');
    }
};