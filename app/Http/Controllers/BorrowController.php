<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Instrument;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instruments = Instrument::all();
        return view('auth.borrow.index', [
            'instruments' => $instruments,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        request()->validate([
            'date' => 'required|date',
            'horario' => 'required',
            'instrument' => 'required|exists:instruments,id',
        ]);
    
        $user_id = auth()->user()->id;
        $day = request()->input('date');
        $time = request()->input('horario');
        $instrument_id = request()->input('instrument');
    
        $existingBorrow = Borrow::where('user_id', $user_id)
            ->where('day', $day)
            ->where('time', $time)
            ->first();
    
        if ($existingBorrow) {
            return redirect()->back()->with('alert', 'danger')->with('message', 'Já existe um agendamento para esta data e horário.');
        }
    
        $borrow = new Borrow();
        $borrow->user_id = $user_id;
        $borrow->day = $day;
        $borrow->instrument_id = $instrument_id;
        $borrow->time = $time;
        $borrow->observations = '';
    
        $borrow->save();
    
        return redirect()->route('borrow.index')->with('alert', 'success')->with('message', 'Agendamento criado com sucesso.');
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
