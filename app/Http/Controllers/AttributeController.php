<?php

namespace App\Http\Controllers;

use App\Models\Attributeline;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $attributes = Attribute::all();
        $attributelines = Attributeline::all();
        $message = null;
        $value = null;
        return view('admin.attributes',compact('attributes','attributelines','message','value'));
    }
    public function create(){
        $attributes = Attribute::all();
        $childattributes = Attributeline::all();
        return view('admin.add-attribute',compact('attributes','childattributes'));
    }

    public function store(Request $request){
        if($request->type == 0){
            $attribute = new Attribute();
            $attribute->value = $request->attr;
            $attribute->save();
        }
        else{
            $attributeline = new Attributeline();
            $attributeline->attribute_id = $request->type;
            $attributeline->value = $request->attr;
            $attributeline->save();
        }
        $request->session()->put('key', $request['type']);
        $value = $request->session()->get('key');
        $attributes = Attribute::all();
        $attributelines = Attributeline::all();
        $message = 'Variation ajoutée avec succés !';
        return view('admin.attributes',compact('value','attributes','attributelines','message'));
    }

    public function edit($id){
        $attribute = Attribute::find($id);
        $attributes = Attribute::all();

        return view('admin.edit-attribute',compact('attribute','attributes'));
    }

    public function update(Request $request , $id){
        $attribute = Attribute::find($id);
        $attribute->value = $request->attr;
        $attribute->save();

        return redirect('admin/attributes');
    }

    public function destroy($id){
        $attribute = Attribute::find($id);
        $attribute->delete();
        return redirect('admin/attributes');
    }
}
