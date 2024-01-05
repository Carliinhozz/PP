<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Music;
use App\Models\Music_playlist;
use App\Models\Playlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Cookie::has('suapTokenExpirationTime') && Cookie::has('suapToken') && Auth::check()){
        
            $morning_playlist=Playlist::where('day',Carbon::today())->where('time',0)->first();
            $musics=Music::all();
            if(isset($morning_playlist)){
                
                $morning_playlist_musics = $musics->intersect(Music::whereIn('id',
                Music_playlist::select('music_id')->where('playlist_id',$morning_playlist->id
                )->get()->toArray() )->get());
                
            }else{
                $morning_playlist_musics = collect();
            }

            $afternoon_playlist=Playlist::where('day',Carbon::today())->where('time',1)->first();
            if(isset($afternoon_playlist)){
            $afternoon_playlist_musics = $musics->intersect(Music::whereIn('id',
            Music_playlist::select('music_id')->where('playlist_id',$afternoon_playlist->id
            )->get()->toArray() )->get());
            }else{
                $afternoon_playlist_musics= collect();
            }

            $from=Carbon::today()->startOfWeek();
            $to=Carbon::today()->endOfWeek()->subDays(6);
            $borrows_monday=Borrow::where('finished',0)->whereBetween('day',[$from,$to])->orderBy('day')->get();

            $from=Carbon::today()->startOfWeek()->addDays(1);
            $to=Carbon::today()->endOfWeek()->subDays(5);
            $borrows_tuesday =Borrow::where('finished',0)->whereBetween('day',[$from,$to])->orderBy('day')->get();

            $from=Carbon::today()->startOfWeek()->addDays(2);
            $to=Carbon::today()->endOfWeek()->subDays(4);
            $borrows_wednesday  =Borrow::where('finished',0)->whereBetween('day',[$from,$to])->orderBy('day')->get();

            $from=Carbon::today()->startOfWeek()->addDays(3);
            $to=Carbon::today()->endOfWeek()->subDays(3);
            $borrows_thursday   =Borrow::where('finished',0)->whereBetween('day',[$from,$to])->orderBy('day')->get();

            $from=Carbon::today()->startOfWeek()->addDays(4);
            $to=Carbon::today()->endOfWeek()->subDays(2);
            $borrows_friday    =Borrow::where('finished',0)->whereBetween('day',[$from,$to])->orderBy('day')->get();
            
            return view('auth.index',[
                'morning_musics'=>$morning_playlist_musics,
                'afternoon_musics'=>$afternoon_playlist_musics,
                'borrows_monday'=>$borrows_monday,
                'borrows_tuesday'=>$borrows_tuesday,
                'borrows_wednesday'=>$borrows_wednesday,
                'borrows_thursday'=>$borrows_thursday,
                'borrows_friday'=>$borrows_friday,

            ]);
            // return var_dump($borrows_friday);
            
            
        }
        Auth::logout();
            
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
        return view('index');
    }
}
