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
}
