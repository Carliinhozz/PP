<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('callback.auth');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function callback(Request $request)
    {
        $res = Http::withUrlParameters([
            'scope' => 'identificacao'
        ])
        ->withToken($request->suap_token)
        ->acceptJson()
        ->get(config('suap.uri_eu'));

        $user= new User([
            'name'=>$res['nome_usual'],
            'registration'=>$res['identificacao'],
            'email_ifrn'=>$res['email_google_classroom'],
            'role'=>$res['tipo_usuario'],
        ]);  

        $user->save();

        Auth::login($user);

        return response($res)->cookie('suapToken', $request->suap_token);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pre_login()
    {
        
        Cookie::queue(Cookie::forget('suapToken'));
        Cookie::queue(Cookie::forget('suapTokenExpirationTime'));
        Cookie::queue(Cookie::forget('suapScope'));
        return redirect(config('suap.uri_login'));
        
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
