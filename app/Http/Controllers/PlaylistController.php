<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Music_playlist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Playlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //Código de selecionar as músicas para a playlist da manhã

        $morning_playlist=Playlist::firstOrCreate([
            'time'=>0,
            'day'=>Carbon::today(),            
        ]);

        $afternoon_playlist=Playlist::firstOrCreate([
            'time'=> 1,
            'day'=>Carbon::today(),
        ]);
        
        
        $morning_playlist->duration=0;
        $morning_playlist_id=[];
        $morning_musics=Music::where('time', 0)->where('already_added', 0)->get();
      
        foreach($morning_musics as $music)
        {
           if ($morning_playlist->duration+$music->duration >1200) {
                break;
            }
            $morning_playlist->duration+= $music->duration;
            array_push($morning_playlist_id, $music->id);
            
        }
        

        //Código de selecionar as músicas para a playlist da tarde
        $afternoon_playlist->duration=0;
        $afternoon_playlist_id=[];
        $afternoon_musics=Music::where('time', 1)->where('already_added', 0)->get();
        
        foreach($afternoon_musics as $music)
        {
            if ($afternoon_playlist->duration+$music->duration >1200) {
                break;
            }
            $afternoon_playlist->duration+= $music->duration;
            array_push($afternoon_playlist_id, $music->id);
            
        }
       

        


        //codigo se a playlist estivar salva
        if(Music_playlist::where('playlist_id',$morning_playlist->id)->get()->isNotEmpty()){
            $morning_playlist->duration=0;
            $musics_playlist=Music_playlist::where('playlist_id',$morning_playlist->id)->get();
            $morning_playlist_id=[];
            foreach ($musics_playlist as $music_playlist) {
                $music=Music::findOrFail($music_playlist->music_id);
                array_push($morning_playlist_id,$music->id);
                $morning_playlist->duration+= $music->duration;
                // return var_dump($musics_playlist);
                
            }
            $morning_musics=Music::where('time', 0)->get();            
        }
        if(Music_playlist::where('playlist_id',$afternoon_playlist->id)->get()->isNotEmpty()){
            $afternoon_playlist->duration=0;
            $musics_playlist=Music_playlist::where('playlist_id',$afternoon_playlist->id)->get();
            $afternoon_playlist_id=[];
            foreach ($musics_playlist as $music_playlist) {
                $music=Music::findOrFail($music_playlist->music_id);
                array_push($afternoon_playlist_id,$music->id);
                $afternoon_playlist->duration+= $music->duration;
                
            }
            $afternoon_musics=Music::where('time', 0)->get();             
        }
        $morning_playlist->save();
        $afternoon_playlist->save();
        session(['morning_ids' => $morning_playlist_id]);
        session(['afternoon_ids' => $afternoon_playlist_id]);
        $morning_playlist_musics = $morning_musics->intersect(Music::whereIn('id',$morning_playlist_id )->get());
        $afternoon_playlist_musics = $afternoon_musics->intersect(Music::whereIn('id',$afternoon_playlist_id )->get());
        
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
        $musics=Music::where('time',$playlist->time)->get();
        

        $available_musics = $playlist->time ? 
        $musics->diff(Music::whereIn('id', session('afternoon_ids'))->get()):
        $musics->diff(Music::whereIn('id', session('morning_ids'))->get());

        $playlist_musics = $playlist->time ?
        $musics->intersect(Music::whereIn('id',session('afternoon_ids') )->get()):
        $musics->intersect(Music::whereIn('id',session('morning_ids') )->get());

        if(Music_playlist::where('playlist_id',$playlist->id)->get()->isNotEmpty()){

            $musics= Music::select('musics.id','musics.duration','musics.title','musics.already_added')->leftjoin('playlist_musics', 'musics.id', '=', 'playlist_musics.music_id')
            ->where('playlist_id', '=', $id)->orWhere('playlist_id', '=', NULL)->where('musics.time','=',$playlist->time)
            ->get();

            $available_musics = $playlist->time ? 
            $musics->diff(Music::whereIn('id', session('afternoon_ids'))->get()):
            $musics->diff(Music::whereIn('id', session('morning_ids'))->get());

            $playlist->duration=0;
            foreach ($playlist_musics as $music) {                               
                $playlist->duration+= $music->duration;
                $playlist->save();
            }
            $available_musics = $playlist->time ? 
            $musics->diff(Music::whereIn('id', session('afternoon_ids'))->get()):
            $musics->diff(Music::whereIn('id', session('morning_ids'))->get());
            $playlist->save();
            // return var_dump($available_musics);             
        }
        

        return view('auth.playlist.add',[
            'musics'=>$available_musics,
            'playlist'=>$playlist,
            'playlist_musics'=>$playlist_musics,
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
        if(!$musics->find($music->id) && in_array($music->id,$musics_ids)){
            return abort(404, 'Música não encontrada');
        }
        array_push($musics_ids, $music->id);
        
        $playlist->time ?session()->forget('afternoon_ids'):session()->forget('morning_ids');
        $playlist->time?session(['afternoon_ids' => $musics_ids]):session(['morning_ids' => $musics_ids]);
        $playlist->duration=$music->duration+$playlist->duration;
        $playlist->save();

        $musics = $playlist->time ? 
        $musics->diff(Music::whereIn('id', session('afternoon_ids'))->get()):
        $musics->diff(Music::whereIn('id', session('morning_ids'))->get());
        

        return redirect(route('playlist.add_index', ['id'=>$playlist->id]));

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $playlist=Playlist::findOrFail($id);
        $all_musics= Music::select('musics.id','musics.duration','musics.title','musics.already_added')->leftjoin('playlist_musics', 'musics.id', '=', 'playlist_musics.music_id')
        ->where('playlist_id', '=', $id)->orWhere('playlist_id', '=', NULL)->where('musics.time','=',$playlist->time)
        ->get();
        
        
        $selected_musics=$playlist->time ?
        $all_musics->intersect(Music::whereIn('id',session('afternoon_ids') )->get()):
        $all_musics->intersect(Music::whereIn('id',session('morning_ids') )->get());

        $unselected_musics=$playlist->time ?
        $all_musics->diff(Music::whereIn('id',session('afternoon_ids') )->get()):
        $all_musics->diff(Music::whereIn('id',session('morning_ids') )->get());

        foreach ($selected_musics as $music) {
            
                $music_playlist=Music_playlist::firstOrCreate([
                    'music_id'=>$music->id,
                    'playlist_id'=>$playlist->id,
                ]);
                $music->already_added=1;
                $music_playlist->save();
                $music->save();
        }
        foreach ($unselected_musics as $music) {
            $music_playlist=Music_playlist::where('music_id',$music->id)->delete();
            $music->already_added=0;
            $music->save();
        }
        return redirect(route('home'));
        // return var_dump($all_musics->find(9));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
            return redirect(route('playlist.add_index', ['id' => $id]));
        }
        return abort(404,'Música não encontrada');
    }
  
}
