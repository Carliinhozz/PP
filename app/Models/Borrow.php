<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
       'day_time',
       'user_id',
       'instrument_id',
       'finished',
       'observations',
    ];

    public function instrument()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instruments()
    {
        return $this->belongsToMany(Instrument::class);
    }
}
