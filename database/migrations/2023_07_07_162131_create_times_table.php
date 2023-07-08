<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->string('time');
            $table->timestamps();
        });
        DB::table('times')->insert(
            [
                ['time' => 'Manhã'],     
                ['time' => 'Almoço'],
                ['time' => 'Tarde']  
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
