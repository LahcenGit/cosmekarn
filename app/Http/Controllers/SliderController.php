<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function index(){
        $sliders = Slider::orderBy('created_at','desc')->get();
        $message = Null;
        return view('admin.slider',compact('sliders' , 'message'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            ]);
    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('public/uploads/sliders');
        $filename = basename($path);
    }
     $slider = new Slider();
     $slider->title = $request->title;
     $slider->description = $request->description;
     $slider->button_value = $request->button_value;
     $slider->text = $request->text;
     $slider->flag = $request->flag;
     $slider->image = $filename;
     $slider->save();
     $message = 'Slider ajouté avec succès';
     $sliders = Slider::orderBy('created_at','desc')->get();
     return view('admin.slider',compact('sliders' , 'message'));
    }
}
