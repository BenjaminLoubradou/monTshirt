<?php

namespace App\Http\Controllers\Shop;

use App\Adresse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProcessController extends Controller
{
    public function __construct()
    {
        // on doit etre loggé pour acceder à toutes les pages du process sauf la page
        $this->middleware('auth')->except('identification');

        // empecher d'acceder au formulaire
        // d'identification/register si on est déjà loggé
        $this->middleware('guest')->only('identification');
    }

    //Etape 1 // identifaction
    public function identification(){

        return view('shop.process.identification');
    }

    // Etape 2 // adresse de livraison
    public function adresse(){

        return view('shop.process.adresse');
    }

    public function adresseStore(Request $request){
        //Récupération des datas du form
//            dd($request->all());
        //Validation
        $request->validate([
            'nom'=>'required',
            'adresse'=>'required',
            'telephone'=>'required | digits:10',
            'code_postale'=>'required',
            'ville'=>'required',
            'pays'=>'required'
        ]);
        //Création de l'entité et hydratation
        $adresse = new Adresse();
        // Hydrater tous les attributs de l'adresse en 1 ligne
        $adresse->fill($request->all());
        //Sauvegardé dans la db
        $adresse->save();

        //Récupération du user connecté pour lui associer l'adresse qui vien d'être créée.
        $user_auth = Auth::user();
        $user_auth->adresse_id = $adresse->id;
        $user_auth->save();

        //Redirection vers la page pour procéder au paiement.
        return redirect(route('order_paiement'));


    }

    public function paiement(){
        $total_a_payer = \Cart::getTolal();
        return view('shop.process.paiement',compact('total_a_payer'));
    }
}
