<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Music;
use App\Models\Playlist;

class Music_playlist extends Model
{
    use HasFactory;
    public function music_id()
    {
        return $this->belongsTo(Music::class, 'music_id', 'id');    
    }
    public function playlist_id()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id', 'id');    
    }
    
    protected $fillable=[
        'playlist_id',
        'music_id',

    ];
    protected $table = 'playlist_musics';
}
