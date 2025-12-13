<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function accueil()
    {
        return view('Accueil');
    }

    public function specialite()
    {
        return view('specialites');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function commentCaMarche()
    {
        return view('comment-ca-marche');
    }
    public function contactezNous()
    {
        return view('contactez-nous');
    }

    public function rendezvous()
    {
        return view('rendez-vous');
    }

    public function choisirMedecin()
    {
        return view('medecin');
    }

    public function dateHeure()
    {
        return view('date-heure');
    }

    public function informations()
    {
        return view('informations');
    }
}
