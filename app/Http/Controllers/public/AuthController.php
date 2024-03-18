<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make(
            # $request permet de recuperer les valeur du formulaire
            $request->all(),
            [
                'nomcomplet' => 'required',
                'email' => 'required|email|max:255|unique:users',
                'siege' => 'required',
                'adresse' => 'required',
                'activites' => 'required',
                'telephone' => 'required|min:8',
                'password' => 'required|min:4',
            ],
            [
                'nomcomplet.required' => 'Le champ nomcomplet est requis.',
                'email.required' => 'Le champ email est requis.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'email.max' => 'L\'adresse email ne doit pas dépasser :max caractères.',
                'email.unique' => 'Cette adresse email est déjà utilisée.',
                'password.required' => 'Le champ mot de passe est requis.',
                'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
                'siege.required' => 'Le champ siege est requis.',
                'adresse.required' => 'Le champ adresse est requis.',
                'telephone.required' => 'Le champ telephone est requis.',
                'activites.required' => 'Le champ domaines d\'activites est requis.',
            ]
        );
          # si les valeur entrer ne correspondent pas les type de données à rentrer vous ne bougerer pas 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        # creation d'un user
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
        return redirect()->route('public.connexion')->with('success','Inscription reusssi ! Veuillez vous connecter.');

    }




    public function inscriptionAbonne()
    {
        return view('public.auth.inscription-abonne');
    }



    public function inscriptionAbonneAction(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required',
                'prenom' => 'required',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required',
                'adresse' => 'required',
                'telephone' => 'required',
                'preferences' => 'required',
            ],
            [
                'nom.required' => 'Le champ nom et prénom est requis.',
                'prenom.required' => 'Le champ nomcomplet et prénom est requis.',
                'email.required' => 'Le champ email est requis.',
                'email.email' => 'Veuillez entrer une adresse email valide.',
                'email.max' => 'L\'adresse email ne doit pas dépasser :max caractères.',
                'email.unique' => 'Cette adresse email est déjà utilisée.',
                'password.required' => 'Le champ mot de passe est requis.',
                'adresse.required' => 'Le champ adresse est requis.',
                'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
                'telephone.required' => 'Le champ telephone est requis.',
                'preferences.required' => 'Le champ preferences est requis.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $abonne = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'password' => $request->password,
            'adresse' => $request->adresse,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'preferences' => $request->preferences,
            'role' => "abonne",
        ]);

        $abonne->save();

        return redirect()->route('public.connexion')->with('success','Inscription reusssi ! Veuillez vous connecter.');
    }

    public function connexion()
    {
        return view('public.auth.connexion');

    }


public function connexionAction(Request $request){
    dd($request->all());
    }
}