<?php

namespace App\Http\Controllers\Shop;

use App\Adresse;
use App\Order;
use App\OrderProduct;
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

    //Etape 3 page paiement
    public function paiement(){
        $total_a_payer = \Cart::getTotal();
        return view('shop.process.paiement',compact('total_a_payer'));
    }

    // Etape 3bis > creation de al commande de la DB
    public function confirmationCommande(){
        //créer l'objet Order>hydrater
        $order = new Order();
        $order->total_ttc = \Cart::getTotal();
        $order->total_ht = \Cart::getSubTotal();
        $order->tva = \Cart::getTotal() - \Cart::getSubTotal();
        $order->taux_tva = 20;

        //Associer Order à une adresse de livraison
        //récupérer le user connecté
        $user = Auth::user();
        $order->adresses_id = $user->adresse_id;

        //Associer Order à l'utilisateur connecté
        $order->user_id = $user->id;
        $order->save();

        //creer l'objet OrderProduct par produit dans le panier
        $products = \Cart::getContent();
        foreach ($products as $product){
            $order_product = new OrderProduct();
            $order_product->qty = $product['quantity'];
            $order_product->prix_unitaire_ht = $product['price'];
            $order_product->prix_unitaire_ttc = $product['price']*1.2;

            $prix_total_ttc = ($product['price'] * $product['quantity']) * 1.2;
            $prix_total_ht = $product['price'] * $product['quantity'];

            $order_product->prix_total_ttc = $prix_total_ttc;
            $order_product->prix_total_ht = $prix_total_ht;
            $order_product->size = $product['attributes']['size'];
            $order_product->order_id = $order->id;
            $order_product->product_id = $product['attributes']['id'];
            $order_product->save();

            // vider le panier
            \Cart::clear();
            // rediriger vers la page Merci
            return redirect(route('order_merci'));
        }
        //
    }

    // Etape 4 > page merci
    public function merci(){
        return view('shop.process.merci');
    }
}
