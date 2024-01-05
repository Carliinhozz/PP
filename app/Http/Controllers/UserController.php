<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Instrument;
use App\Models\Instrument_model;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function perfil()
    {
        $musics = Music::where('user_id', Auth::id())->where('already_added', 0)->get();
        $borrows = Borrow::where('user_id', Auth::id())->get();
        $isntruments=Instrument::all();
        $instrument_models=Instrument_model::all();

        $borrows = Borrow::where('user_id', auth()->user()->id)
        ->orderBy('day')->where('finished',0)
        ->get();
    
        return view('auth.user.perfil', ['borrows' => $borrows, 'musics' => $musics, 'instrument_models'=>$instrument_models,
        'instruments'=>$isntruments,]);
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
