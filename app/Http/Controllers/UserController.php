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
    public function index()
    {
        $admins=User::where('admin',1)->get();
        $result=collect();
        return view('auth.admin.index',[
            'admins'=>$admins,
            'result'=>$result,
        ]);
    }
    public function search(Request $request)
    {
        $admins=User::where('admin',1)->where('role','Aluno')->get();
        $validate=$request->validate([
            'registration'=>'required'
        ]);
        $result=User::where('registration',$request->registration)->get();
        return view('auth.admin.index',[
            'admins'=>$admins,
            'result'=>$result,
        ]);
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
    public function promote(string $id)
    {
        $user=User::findOrFail($id);
        $user->admin=1;
        $user->save();
        return redirect(route('admin.index'));
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
        $user=User::findOrFail($id);
        $user->admin=0;
        $user->save();
        return redirect(route('admin.index'));
    }
}
