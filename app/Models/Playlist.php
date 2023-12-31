<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Time;

class Playlist extends Model
{
    use HasFactory;
    protected $fillable = [
       'day',
       'time',
       'duration',
    ];
    protected $table = 'playlists';
}
