<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowInstrument extends Model
{
    protected $table = 'borrow_instrument';

    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

}
