<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instrument;
use App\Models\User;

class Borrow extends Model
{
    use HasFactory;
    public function instrumentId()
    {
        return $this->belongsTo(Instrument::class, 'instrument_id', 'id');    
    }
    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');    
    }
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
}

