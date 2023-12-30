<?php

namespace App\Http\Controllers;

use App\Models\Music_playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
 

use App\Models\Music;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'search' => 'required',
        ]);
        $search=$request->search;
        $response = json_decode(Http::get("https://api.deezer.com/search/track?q=$search&limit=10"));
        $is_worked=true;
        return view('auth.music.index',['response' => $response->data, 'search'=>$search, 'it_worked'=>$is_worked]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    { 
        $validated= $request->validate([
            'time'=>'required',
        ]);
        
        $response = json_decode(Http::get("https://api.deezer.com/track/$id"));
        $music= new Music;
        $music->deezer_id=$response->id;
        $music->title=$response->title;
        $music->artist=$response->artist->name;
        $music->time=$request->time;
        $music->duration=$response->duration;
        $music->user_id=Auth::id();
        $music->save();
        return redirect(route('music.index'));   
        
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }
    // return view('auth.music.show');
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
    public function destroy(string $id, string $music_id)
    {
        if(Music_playlist::where('music_id',$music_id)->get()->isNotEmpty()){
            return abort(404);
        }
        $music=Music::findOrFail($music_id);
        $music->delete();
        return redirect(route('playlist.add', ['id'=>$id]));

    }
}
