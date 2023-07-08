<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Time;

class Playlist extends Model
{
    use HasFactory;
    public function time()
    {
        return $this->belongsTo(Time::class, 'time_id', 'id');    
    }

    protected $fillable = [
       'day',
       'time_id',
    ];
}
