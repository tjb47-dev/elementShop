<?php

namespace App\Http\Controllers;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {

        //using product model to pull all the products
        $products = Products::all();
        //return all the products
        return($products);
    }

    public function create(Request $request) {
        //create a new product
        $data = array(
            "name" => $request->name,
            "price" => $request->price, 
            "description" => $request->description,
            "image" => $request->image
        );
        //return the new product
        return Products::create($data);
    }

    public function addCart($id){
        //add the product to the cart
        $product = Products::find($id);
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
