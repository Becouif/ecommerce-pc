<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            // name should be unique in category table 
            'name'=>'required|unique:categories',
            'description'=>'required',
            'image'=>'required|mimes:png,jpeg,jpg'
        ]);

        // access image and save image to pubic files inside storage 
        $image= $request->file('image')->store('public/files');
        Category::create([
            'name'=> $request->name,
            'slug'=>Str::slug($request->name),
            'description'=> $request->description,
            'image'=>$image
        ]);
        return redirect()->route('category.index')->with('message','Category successfully created');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
