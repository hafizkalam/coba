<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $data['data'] = User::get();
        $data['jsTambahan'] = "$('#user').addClass('active') ;";
        return view('admin.user', $data);
    }

    public function createedit(Request $request)
    {

        $test = Auth::user();

        $vaUpdate = array(
            "id" => $request->id,
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make("123"),
            "level" => "2",
            // "profile" => $fileName,
            "desc" => $request->desc,
        );

        $vaTenant = array(
            "name" => $request->name,
            "profile" => "",
            "desc" => "",
            "user_id" => $request->id
        );

        if ($request->hasFile('profile')) {
            // $path = $request->file('url')->store('user');
            $file = Request()->profile;
            $fileName = Request()->name . time() . '.' . $file->extension();
            $file->move(public_path('profile_users'), $fileName);
            $vaUpdate['profile'] = $fileName;
        }
        if ($request->has('edit')) {
            User::where('id', $request->id)->update($vaUpdate);
            MasterTenant::where('user_id', $request->id)->update(["name" => $request->name]);
        } else {
            $cek = User::create($vaUpdate);
            $vaTenant = array(
                "name" => $request->name,
                "profile" => "",
                "desc" => "",
                "user_id" => $cek->id
            );
            MasterTenant::create($vaTenant);
            $request->session()->put('notif', "Data berhasil ditambahkan");
        }

        return redirect('user');
    }

    public function destory($id, $name)
    {
        User::where('id', $id)->delete();
        MasterTenant::where('user_id', $id)->delete();
        return redirect('user');
    }
}
