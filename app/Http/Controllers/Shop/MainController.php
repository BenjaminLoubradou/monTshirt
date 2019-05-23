<?php

namespace App\Http\Controllers\Shop;

use App\Category;
use App\Product;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //
    public function test(Request $request){
        $prenom = $request->prenom;
//        echo $prenom;
//        die();
        return view('test',['prenom'=>$prenom]);
        // permet à la test.blade.php d'acceder à $prenom;
    }

    public function index(){
        $products = Product::all(); // SELECT * FROM products
        $categories = Category::all();
        //dd($products);
        //dd($var) >> var_dump($var) + die();
        return view('shop.index',['products'=>$products]);
    }

    public function product(Request $request){
        $id_product = $request->id;
        // SELECT * FROM product WHERE id = id_product
        $product = Product::find($id_product);
//        $categories = Category::all();

        return view('shop.product',compact('product'));
        //compact($product) >>> ['product'=>$product]
    }

    public function viewByCat(Request $request){
        $id_category = $request->id;
        $category = Category::find($id_category);
        $products = $category->products;
        return view('shop.category',compact('category','products'));

    }

    public function viewByTag(Request $request){
        $id_tag = $request->id;
        $tag = Tag::find($id_tag);
        $products = $tag->products;
        return view('shop.category',compact('products','tag'));
    }
}
