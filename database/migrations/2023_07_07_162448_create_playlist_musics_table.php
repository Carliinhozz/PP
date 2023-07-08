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
        Schema::create('playlist_musics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('playlist_id');
            $table->foreign('playlist_id')->references('id')->on('playlists');
            $table->unsignedBigInteger('music_id');
            $table->foreign('music_id')->references('id')->on('musics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_musics');
    }
};
