<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    function edit(Request $request){
        $id = Auth::user()->id;
        $data = $request->all() ;
        unset($data['_token']) ;
        if ($request->hasFile('profile')) {
            $file = Request()->profile;
            $fileName = Request()->name . time() . '.' . $file->extension();
            $file->move(public_path('profile_users'), $fileName);
            $data['profile'] = $fileName;
        }
        if(isset($data['status'])){
            $data['status'] = 1 ;
        }else{
            $data['status'] = 0;
        }
        MasterTenant::where("user_id",$id)->update($data) ;
        return redirect('/info-tenant');
    }

    function show(){
        $id = Auth::user()->id;
        $data['tenant'] = MasterTenant::where("user_id", $id)->first();

        $data['jsTambahan'] = "$('#info').addClass('active') ;";
        return view("admin.tenant",$data) ;
    }
    //
}
