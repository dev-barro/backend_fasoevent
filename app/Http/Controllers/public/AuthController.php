<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function inscriptionOption()
    {
        return view('public.auth.inscription-option');
    }
    
    public function inscriptionPromoteur()
    {
        return view('public.auth.inscription-promoteur');
    }
    #fonction de gestion des inscriptions pour les promoteurs
    public function inscriptionPromoteurAction( Request $request){
        $promoteur=User::create([
            'nomcomplet'=> $request->nomcomplet,
            'email'=> $request->email,
            'password'=> $request->password,
            'siege'=> $request->siege,
            'telephone'=> $request->telephone,
            'activities'=> $request->activites,
            'role'=> "promoteur",
            'status'=> "en_attente",
            
        ]);
        #le return soute dessous nous redirige vers une route
        return redirect()->route('public.inscription-promoteur');

    }
    public function inscriptionAbonne()
    {
        return view('public.auth.inscription-abonne');
    }
    public function connexion()
    {
        return view('public.auth.connexion');
    }
}
