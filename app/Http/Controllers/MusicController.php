<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 

use App\Models\Music;
class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.music.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $search=$request->search;
        $response = json_decode(Http::get("https://api.deezer.com/search/track?q=$search&limit=10"));
        return view('auth.music.index',['response' => $response->data, 'search'=>$search]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    { 
        
 
        // return redirect(route("musicas.store"));
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
