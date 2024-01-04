<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Instrument;

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

        $borrow = new Borrow();
        $borrow->user_id = auth()->user()->id;
        $borrow->day = request()->input('date');
        $borrow->instrument_id = request()->input('instrument');
        $borrow->time = request()->input('horario'); 
        $borrow->observations = '';

        $borrow->save();

        return redirect()->route('borrow.index');
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
