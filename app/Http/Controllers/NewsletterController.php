<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //
    public function store(Request $request){
        $email = Newsletter::where('email',$request->email)->count();
        if($email == 0){
        $newsletter = new Newsletter();
        $newsletter->email= $request->email;
        $newsletter->save();
        return true;
        }
        else{
            return false;
        }
        return redirect('/');
    }
}
