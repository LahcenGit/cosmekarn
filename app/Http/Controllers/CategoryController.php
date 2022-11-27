<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){

        $categories = Category::where('parent_id',null)->orderby('designation', 'asc')->get();
        $countcategory = Category::count();
        return view('admin.categories',compact('categories','countcategory'));
    }

    public function create(){
        $categories = Category::where('parent_id',null)->get();
        return view('admin.add-category',compact('categories'));
    }

    public function store(Request $request){

        $request->validate([
         'designation' => ['required', 'string', 'max:255'],
         ]);
         $category = new Category();
         $category->designation = $request['designation'];
         $category->description = $request['description'];

         if($request['category'] == 0){
          $category->parent_id == NULL;
         }
         else{
             $category->parent_id = $request['category'];
         }
         $category->save();
         return redirect('admin/categories');
    }
}
