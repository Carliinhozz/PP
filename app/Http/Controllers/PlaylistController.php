<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\Playlist;
use Carbon\Carbon;



class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Código de selecionar as músicas para a playlist da manhã
        $morning_playlist_duration=0;
        $morning_playlist_id=[];
        $morning_musics=Music::where('time', 0)->where('already_added', 0)->get();
      
        foreach($morning_musics as $music)
        {
           if ($morning_playlist_duration+$music->duration >1200) {
                break;
            }
            $morning_playlist_duration+= $music->duration;
            array_push($morning_playlist_id, $music->id);
            
        }
        $morning_playlist_musics = $morning_musics->intersect(Music::whereIn('id',$morning_playlist_id )->get());
        
        
        
        return view('auth.playlist.index',['musics'=>$morning_playlist_musics, 'playlist_duration'=>$morning_playlist_duration]);
        // return Carbon::today('America/Sao_Paulo');
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
