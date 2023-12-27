<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');    
    }
    protected $fillable=[
        'id',
        'title',
        'duration',
        'artist',
        'time',
        'already_added',
        'user_id',

    ];
    protected $table = 'musics';
}
