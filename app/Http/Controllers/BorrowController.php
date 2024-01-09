<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Instrument;
use Illuminate\Support\Carbon;
use App\Models\BorrowInstrument;
use App\Models\User;
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
            'instruments' => 'required|array',
            'instruments.*' => 'exists:instruments,id',
        ]);

        $user_id = auth()->user()->id;
        $day = request()->input('date');
        $time = request()->input('horario');
        $instrument_ids = request()->input('instruments');

        $existingBorrow = Borrow::where('day', Carbon::createFromDate($day)->hour($time))
        ->where('time', 'like', "$time%")
        ->exists();
    
    if ($existingBorrow) {
        return redirect()->back()->with('alert', 'danger')->with('message', 'Já existe um agendamento para esta data e horário.');
    }
    

        $borrow = new Borrow();
        $borrow->user_id = $user_id;
        $borrow->day = Carbon::createFromDate($day)->hour($time);
        $end = $time + 1;
        $borrow->time = $time . '-' . $end . 'h';
        $borrow->observations = '';
        $borrow->save();

        foreach ($instrument_ids as $instrument_id) {
            $borrowInstrument = new BorrowInstrument();
            $borrowInstrument->borrow_id = $borrow->id;
            $borrowInstrument->instrument_id = $instrument_id;
            $borrowInstrument->save();
        }

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
        $borrow=Borrow::findOrFail($id);
        $user=User::findOrFail($borrow->user_id);
        return view('auth.borrow.edit',[
            'borrow'=>$borrow,
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate=$request->validate([
            'observations'=>'required',
        ]);
        $borrow=Borrow::findOrFail($id);
        $borrow->observations=$request->observations;
        $borrow->save();
        return redirect('/perfil#allagendamentos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $borrow = Borrow::findOrFail($id);

        if ($borrow && $borrow->user_id == Auth::id()) {

            $borrow->instruments()->detach();
            $borrow->delete();

            return redirect('perfil');
        }

    }
}