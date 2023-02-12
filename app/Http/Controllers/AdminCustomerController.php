<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    //
    public function index(){
        $customers = User::where('type','customer')->get();
        return view('admin.customers',compact('customers'));
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/customers');

    }
}
