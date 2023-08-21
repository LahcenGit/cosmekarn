<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Attributeline;
use Illuminate\Http\Request;

class AttributelineController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit($id){
        $attributeline = Attributeline::find($id);
        $attributes = Attribute::all();
        return view('admin.edit-attributeline',compact('attributeline','attributes'));
    }
    public function update(Request $request , $id){
        if($request->type == 0){
            $attribute = new Attribute();
            $attributeline = Attributeline::find($id);
            $attribute->value = $request->attr;
            $attributeline->delete();
            $attribute->save();
        }
        else{
            $attributeline = Attributeline::find($id);
            $attributeline->attribute_id = $request->type;
            $attributeline->value = $request->attr;
            $attributeline->save();
        }
        return redirect('admin/attributes');
    }


    public function destroy($id){
        $attributeline = Attributeline::find($id);
        $attributeline->delete();
        return redirect('admin/attributes');
    }
}
