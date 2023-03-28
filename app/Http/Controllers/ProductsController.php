<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {

        $products = Products::all();
        return($products);
    }

    public function create(Request $request) {
        $data = array(
            "name" => $request->name,
            "price" => $request->price, 
            "description" => $request->description,
            "image" => $request->image
        );
        return Products::create($data);
    }

    public function addToCart($id){
        $product = Products::findOrFail($id);
        $cart = session()->get('cart', []);
      
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
            ];
        }
              
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
}
