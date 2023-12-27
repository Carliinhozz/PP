<?php

namespace App\Http\Controllers;

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
    /*
     
    @if ( $response != null)
    <div class="card-deck">
        {{-- FIXME: arrumar o sistema de cartões ou pensar em uma forma melhor --}}
        
            <div class="card" style="width: 18rem;">
                <img src="{{$response->album->cover_big}}" class="card-img-top img-fluid" alt="...">
                <div class="card-body">
                <h5 class="card-title">{{$response->title}}</h5>
                <p class="card-text">{{$response->artist->name}}</p>
                <a href="#" class="btn btn-primary">Solicitar música</a>
                </div>
            </div>
        
    </div>
@else
    */

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
    public function destroy(string $id)
    {
        //
    }
}
