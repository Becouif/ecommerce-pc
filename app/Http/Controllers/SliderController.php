<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::get();
        return view('admin.slider.index',compact('sliders'));
    }
    public function create(){
        return view('admin.slider.create');
    }
       
    public function store(Request $request){
        $this->validate($request,[
            'image'=>'required|mimes:jpeg,jpg,png'
        ]);
        $image = $request->file('image')->store('public/slider');
        Slider::create([
            'image'=>$image
        ]);
        notify()->success('slider image successfully uploaded');
        return redirect()->route('slider.create');
    }
}
