<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Database\Eloquent\Collection;
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

        //Código de selecionar as músicas para a playlist da tarde
        $afternoon_playlist_duration=0;
        $afternoon_playlist_id=[];
        $afternoon_musics=Music::where('time', 1)->where('already_added', 0)->get();
        
        foreach($afternoon_musics as $music)
        {
            if ($afternoon_playlist_duration+$music->duration >1200) {
                break;
            }
            $afternoon_playlist_duration+= $music->duration;
            array_push($afternoon_playlist_id, $music->id);
            
        }
        $afternoon_playlist_musics = $afternoon_musics->intersect(Music::whereIn('id',$afternoon_playlist_id )->get());






        $morning_playlist=Playlist::firstOrCreate([
            'time'=>0,
            'day'=>Carbon::today(),            
        ]);
        
        $morning_playlist->duration=$morning_playlist_duration;
        $morning_playlist->save();
       
   
        $afternoon_playlist=Playlist::firstOrCreate([
            'time'=> 1,
            'day'=>Carbon::today(),
        ]);
        $afternoon_playlist->duration=$afternoon_playlist_duration;
        $afternoon_playlist->save();
        
       
       
        
        
        
        session(['morning_ids' => $morning_playlist_id]);
        session(['afternoon_ids' => $afternoon_playlist_id]);
        
        return view('auth.playlist.index',[
        'morning_playlist_musics'=>$morning_playlist_musics,
        'afternoon_playlist_musics'=>$afternoon_playlist_musics,
        'morning_playlist'=>$morning_playlist,
        'afternoon_playlist'=>$afternoon_playlist,
         ]);
      
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function add_index(string $id)
    {
        $playlist=Playlist::findOrFail($id);
        $musics=Music::where('already_added',0)->where('time',$playlist->time)->get();
        $musics = $playlist->time ? 
        $musics->diff(Music::whereIn('id', session('afternoon_ids'))->get()):
        $musics->diff(Music::whereIn('id', session('morning_ids'))->get());

        return view('auth.playlist.add',[
            'musics'=>$musics,
            'playlist'=>$playlist
        ]);
    }
    public function add_store(string $id, string $music_id)
    {

        $playlist=Playlist::findOrFail($id);
        $music=Music::findOrFail($music_id);
        if($playlist->duration+$music->duration>1230){
            return 'A duração da playlist estrapolou o limite';
        }
        $musics_ids=$playlist->time ?
                session('afternoon_ids'):
                session('morning_ids');

        $musics=Music::where('already_added',0)->where('time',$playlist->time)->get();
        if($musics->find($music->id)->isEmpty() && in_array($music->id,$musics_ids)){
            return abort(404);
        }
        array_push($musics_ids, $music->id);
        
        $playlist->time ?session()->forget('afternoon_ids'):session()->forget('morning_ids');
        $playlist->time?session(['afternoon_ids' => $musics_ids]):session(['morning_ids' => $musics_ids]);
        $playlist->duration+=$music->duration;
        $playlist->save();

        $musics = $playlist->time ? 
        $musics->diff(Music::whereIn('id', session('afternoon_ids'))->get()):
        $musics->diff(Music::whereIn('id', session('morning_ids'))->get());
        

        return redirect(route('playlist.add_index', ['id'=>$playlist->id]));
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
        $playlist=Playlist::findOrFail($id);
        $musics=Music::where('already_added',0)->where('time',$playlist->time)->get();
        $stored_musics=$musics;
        $musics=$playlist->time ?
        $musics->intersect(Music::whereIn('id',session('afternoon_ids') )->get()):
        $musics->intersect(Music::whereIn('id',session('morning_ids') )->get());
        if($musics->isEmpty() && $stored_musics->isEmpty()){
            return redirect(route('music.index'));
        }elseif($musics->isEmpty() && $stored_musics->isNotEmpty()){
            return redirect(route('playlist.add', ['id'=>$playlist->id]));
        }

        
        return view('auth.playlist.show',[
            'playlist'=>$playlist,
            'musics'=>$musics
         ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Music $musics)
    {
        
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
    public function delete(string $id, string $music_id)
    {
        
        $playlist=Playlist::findOrFail($id);
        $music=Music::findOrFail($music_id);
        $musics_ids=$playlist->time ?
        session('afternoon_ids'):
        session('morning_ids');
        if(in_array($music_id,$musics_ids))  {
            $index=array_search($music_id,$musics_ids);
            unset($musics_ids[$index]);
            $playlist->time ?session()->forget('afternoon_ids'):session()->forget('morning_ids');
            $playlist->time?session(['afternoon_ids' => $musics_ids]):session(['morning_ids' => $musics_ids]);
            $playlist->duration-=$music->duration;
            $playlist->save();
            return redirect(route('playlist.show', ['id' => $id]));
        }
        return abort(404,'Música não encontrada');
    }
  
}
