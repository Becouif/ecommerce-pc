<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'image'=>'mimes:jpg,jpeg,png',
            'additional_info'=>'required',
            'price'=>'required|numeric',
            'category'=>'required'
        ]);
        $image = $request->file('image')->store('public/product');
        Product::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'image'=>$image,
            'price'=> $request->price,
            'additional_info' => $request->additional_info,
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory
        ]);
        notify()->success('product successfully created');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function loadSubcategory(Request $request, string $id){
        $subcategory = Subcategory::where('category_id',$id)->pluck('name','id');
        // convert what is coming to json 
        return response()->json($subcategory);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $image = $product->image;
        if($request->file('image')){
            $image = $request->file('image')->store('public/product');
            \Storage::delete($product->image);

            $product->name = $request->name;
            $product->description = $request->description;
            $product->image = $image;
            $product->additional_info = $request->additional_info;
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->subcategory_id = $request->subcategory;
            $product->save();
        } else {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->additional_info = $request->additional_info;
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->subcategory_id = $request->subcategory;
            $product->save();
        }
        notify()->success('product successfully updated');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $image = $product->image;
        $product->delete();
        \Storage::delete($image);
        notify()->success('product successfully deleted');
        return redirect()->route('product.index');
    }
}
