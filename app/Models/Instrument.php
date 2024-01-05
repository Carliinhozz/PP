<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instrument_model;

class Instrument extends Model
{
    use HasFactory;
    public function model()
    {
        return $this->belongsTo(Instrument_model::class, 'model_id', 'id');    
    }
    protected $fillable = [
        'name',
       'description',
       'model_id',
       'institucional_code',
       'disponibility',
    ];

    public function borrows()
    {
        return $this->belongsToMany(Borrow::class);
    }
}
