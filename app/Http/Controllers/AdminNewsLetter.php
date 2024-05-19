<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class AdminNewsLetter extends Controller
{
    //
    public function index(){
        $emails = Newsletter::orderBy('created_at','desc')->get();
        return view('admin.newsletters-emails',compact('emails'));
    }
}
