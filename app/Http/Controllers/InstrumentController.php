<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Instrument_model;
use Illuminate\Http\Request;
use App\Models\Instrument;
class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isntruments=Instrument::all();
        $instrument_models=Instrument_model::all();
        return view('auth.instruments.index',[
            'instrument_models'=>$instrument_models,
            'instruments'=>$isntruments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'instrument_model'=>'required',
            'institucional_code'=>'required',
        ]);

        $instrument=Instrument::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'model_id'=>$request->instrument_model,
            'institucional_code'=>$request->institucional_code,

        ]);
        $instrument->save();
        return redirect(route('instruments.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instrument=Instrument::findOrFail($id);
        $instrument_models=Instrument_model::all();
        $delete_condicion=Borrow::where('instrument_id',$instrument->id)->get()->isEmpty()?
        true:
        false;
        
        return view('auth.instruments.show',[
            'instrument'=> $instrument,
            'delete_condicion'=>$delete_condicion,
            'instrument_models'=>$instrument_models,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
    
        $instrument = Instrument::findOrFail($id);
        $instrument->update([
            'disponibility' => $request->disponibility,
            'description' => $request->description,
        ]);
    
        return redirect('/perfil#ficha-instrumentos');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'instrument_model'=>'required',
            'institucional_code'=>'required',
        ]);

        $instrument=Instrument::findOrFail($id);
        $instrument->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'model_id'=>$request->instrument_model,
            'institucional_code'=>$request->institucional_code,
        ]);
        $instrument->save();
        return redirect(route('instruments.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Borrow::where('instrument_id',$id)->get()->isEmpty()?
        Instrument::find($id)->delete():
        abort(404);
        return redirect(route('instruments.index'));
        
    }
    
}
