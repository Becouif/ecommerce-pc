<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Product $product){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }
        else {
            $cart = new Cart();
        }
        $cart->add($product);
        // return $cart;

        session()->put('cart',$cart);
        notify()->success('product added to cart');
        return redirect()->back();
    }

    public function showCart(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));

        } else {
            $cart = null;
        }
        // dd($cart->items);
        return view('cart',compact('cart'));
    }

    public function updateCart(Request $request, Product $product){
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id,$request->qty);
        session()->put('cart',$cart);
        notify()->success('cart updated ');
        return redirect()->back();
    }

    public function removeCart(Product $product){
        $cart = new Cart(session()->get('cart'));
        // remove function in cart 
        $cart->remove($product->id);
        if($cart->totalQty<= 0){
            session()->forget('cart');
        } else {
            session()->put('cart',$cart);
           
        };
        notify()->success('cart updated');
        return redirect()->back();
    }
}
