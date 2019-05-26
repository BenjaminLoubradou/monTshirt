<?php

namespace App\Http\Controllers\Shop;

use App\Product;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    //
    public function add(Request $request){
//        dd($request->id);
        $id_product = $request->id;
        $product = Product::find($id_product);
        \Cart::add(array(
            'id' => $id_product,
            'name' => $product->nom,
            'price' => $product->prix_ht,
            'quantity' => $request->qty,
            'attributes' => array(
                'size'=>$request->size,
                'photo'=>$product->photo_principale)
        ));
        //redirection vers la page du panier
        return redirect(route('cart'));
    }

    // afficher le contenu du panier
    public function cart(){
        // récuperer les produits ajoutés au panier
        $products_cart = \Cart::getContent()->Sort();
        $total_panier_ht = \Cart::getSubTotal();
        $condition = new CartCondition([
            'name'=>'VAT 20%',
            'type'=>'tax',
            'target'=>'total',
            'value'=>'20%'
        ]);
        // appliquer la condition au panier
        \Cart::condition($condition);
        // récupérer le total TTC du panier
        $total_panier_ttc = \Cart::getTotal();

        return view('shop.cart',compact('products_cart','total_panier_ht','total_panier_ttc'));
    }

    public function update(Request $request){
        // mettre à jour la quantité d'un produit
        $qty = $request->qty;
        // rediriger vers la page paner avec les données de prix actualitées
        \Cart::update($request->id,array(
            'quantity' => array(
                'relative' => false,
                'value' => $qty
            ),
        ));
        //redirection vers la page panier
        return redirect(route('cart'));
    }

    public function remove(Request $request){
        $id_product = $request->id;
        \Cart::remove($id_product);
        return redirect('cart');
    }
}
