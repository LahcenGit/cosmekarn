<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use TheHocineSaad\LaravelAlgereography\Models\Wilaya;

class AdminCustomerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $customers = User::where('type','customer')->get();
        return view('admin.customers',compact('customers'));
    }
    public function edit($id){
        $user = User::find($id);
        $wilayas = Wilaya::all();
        return view('admin.edit-customer',compact('user','wilayas'));
    }

    public function update(Request $request , $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->wilaya = $request->wilaya;
        $user->save();
        return redirect('admin/customers');
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/customers');

    }

    public function customerProfil($id){
        $user = User::find($id);
        $orders = Order::where('user_id',$id)->get();
        return view('admin.customer-profil',compact('user','orders'));
    }
}
