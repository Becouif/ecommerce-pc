<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

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
        $productFromSameCategories = Product::inRandomOrder()->where('category_id',$product->category_id)->where('id','!=',$product->id)->limit(3)->get();
        return view('show',compact('product','productFromSameCategories'));
    }

    public function all($name, Request $request){
        $category = Category::where('slug',$name)->first();
        $categoryId = $category->id;
        if($request->subcategory){
            $filterSubcategories = $this->getSubcategoriesId($request);
            // $filterSubcategories not working well after compact 
            $products = $this->filterProducts($request);

        } elseif($request->min || $request->max){
            $products= $this->filterByPrice($request);
        }
        else {
            $products = Product::where('category_id',$category->id)->get();
        }
        
        $subcategories = Subcategory::where('category_id',$category->id)->get();
        $slug  = $name;
        return view('category',compact('products','subcategories','slug','categoryId'));
    }


    public function filterProducts(Request $request){
        $subId = [];
        $subcategory = Subcategory::whereIn('id',$request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId,$sub->id);
        }
        $products = Product::whereIn('subcategory_id',$subId)->get();
        return $products;

    }

    public function getSubcategoriesId(Request $request){
        $subId = [];
        $subcategory = Subcategory::whereIn('id',$request->subcategory)->get();
        foreach($subcategory as $sub){
            array_push($subId,$sub->id);
        }
        return $subId;

    }
    public function filterByPrice(Request $request){
        $categoryId = $request->categoryId;
        $product = Product::whereBetween('price',[$request->min,$request->max])->where('category_id',$categoryId)->get();
        return $product;
    }


    public function moreProducts(Request $request){
        // implmenting the search in the more product 
        if($request->search){
            $products = Product::where('name','like','%'.$request->search.'%')
            ->orWhere('description','like','%'.$request->search.'%')
            ->orWhere('additional_info','like','%'.$request->search.'%')
            ->paginate(50);
            return view('all-product',compact('products'));
        }
        $products = Product::latest()->paginate(50);
        return view('all-product',compact('products'));
    }
}
