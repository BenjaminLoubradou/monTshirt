<?php

namespace App\Http\Controllers\Backend;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //afficher le formulaire d'identification
    public function loginBackend(){

        return view('backend.login');
    }

    // afficher la page liste des commandes
    public function index(){
//        $orders = Order::all();
        $orders = Order::paginate(5);
        //Select
        return view('backend.index',compact('orders'));
    }

    // afficher le détails d'une commande
    public function orderShow(Request $request){
        $order_id = $request->id;
        $order = Order::find($order_id);
        return view('backend.orderShow',compact('order'));
    }

}
