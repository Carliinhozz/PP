<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument_model extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
       'model',
       
    ];
    protected $table = 'instrument_models';
}
