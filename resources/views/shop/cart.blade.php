@extends('shop')
@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="jumbotron-heading"> <span class="badge badge-primary ">Votre panier </span></h1>
            @if($total_products_cart > 0)
            <table class="table table-bordered table-responsive-sm">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Qte</th>
                    <th>P.U</th>
                    <th>Total TTC</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products_cart as $product) {{-- pour chaque produits dans le panier --}}
                <tr>
                    <td>
                        <img width="110" class="rounded-circle img-thumbnail"
                             src="produits/{{$product->attributes->photo}}" alt="">
                        {{$product->name}} / Taille : {{strtoupper($product->attributes->size)}} {{-- on affiche la taille du tshirt afin d'avoir la différence entre deux tshirt identique de taille différente --}}
                        {{-- name fait appelle au nom d'un tshirt
                        dans le tableau \cart::add en fonction du produit--}}
                        <a href="{{route('cart_remove',['id'=>$product->id])}}"  class="btn btn-danger col-1 offset-2" >
                            <i class="fas fa-trash" ></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{route('cart_update')}}" id="update_qty_{{$product->id}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input name="qty" style="display: inline-block" id="qte"
                                   class="form-control col-sm-4" type="number" value="{{$product->quantity}}" min="1">

                        <button  form="update_qty_{{$product->id}}" class="pl-2 btn btn-light">
                            <i class="fas fa-sync"></i>
                        </button>
                        </form>
                    </td>
                    <td>
                        {{number_format(($product->price*1.2),2)}}
                        {{-- price fait appelle à la valeur du prix d'un tshirt
                        dans le tableau \cart::add en fonction du produit--}}
                    </td>
                    <td>
                        {{number_format((($product->price*$product->quantity)*1.2),2)}}
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td>Total HT</td>
                    <td>{{ number_format($total_panier_ht,2) }} €</td> {{-- on appelle total_panier_ht --}}
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>TVA (20%)</td>
                    <td>{{ number_format(($total_panier_ttc - $total_panier_ht),2) }} €</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Total TTC</td>
                    <td>{{ number_format($total_panier_ttc,2) }} €</td>
                </tr>
                </tfoot>
            </table>
            <a class="btn btn-block btn-outline-dark" href="{{route('order_auth')}}">Commander</a>
            @else
                <p>Votre panier est vide...
                    <a href="{{route('homepage')}}">
                        <br><br>
                        Continuez vos achats
                    </a>
                </p>
            @endif
        </div>
    </section>
@endsection
