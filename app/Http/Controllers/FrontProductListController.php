<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    public function index(){
        $products = Product::latest()->limit(9)->get();
        $randomActiveProducts = Product::inRandomOrder()->limit(3);
        $randomActiveProductsIds = [];
        foreach($randomActiveProducts as $product){
            array_push($randomActiveProductsIds,$product->id);
        }
        $randomItemProducts = Product::where('id','!=',$randomActiveProductsIds)->limit(3)->get();
        return view('product',compact('products','randomItemProducts','randomActiveProducts'));
    }
    public function show($id){
        $product = Product::find($id);

        return view('show',compact('product',));
    }
}
