<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index(){
        $settings = Setting::all();
        return view('admin.setting',compact('settings'));
    }
    public function store(Request $request){
     $setting = new Setting();
     $setting->name = $request->designation;
     $setting->value = $request->value;
     $setting->status = $request->status;
     $setting->save();
     return redirect()->back();
        }

    public function edit($id){
        $setting = Setting::find($id);
        $settings = Setting::all();
        return view('admin.edit-setting',compact('setting','settings'));
    }

    public function update(Request $request , $id){
        $setting = Setting::find($id);
        $setting->name = $request->designation;
        $setting->value = $request->value;
        $setting->status = $request->status;
        $setting->save();
        return redirect('admin/setting');
    }

    public function destroy($id){
        $setting = Setting::find($id);
        $setting->delete();
        return redirect()->back();
    }
}
