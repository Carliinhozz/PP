<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InstrumentType;

class Instrument extends Model
{
    use HasFactory;
    public function type()
    {
        return $this->belongsTo(InstrumentType::class, 'type_id', 'id');    
    }
    protected $fillable = [
       'description',
       'type_id',
       'control_code',
    ];
}
