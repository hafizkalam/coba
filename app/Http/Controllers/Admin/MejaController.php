<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MejaController extends Controller
{
    public function show(Request $request)
    {
        // dd($request->session()->get('nofaktur'));
        $data['user'] = Auth::user();
        $data['meja'] = Meja::get();
        $data['jsTambahan'] = "$('#meja').addClass('active') ;";

        return view('admin.meja', $data);
    }

    public function create(Request $request)
    {
        // $meja = new Meja;
        // $meja->no_meja = $request->no_meja;
        // $meja->save();
        // return redirect('meja');

        $inputNomorMeja = $request->input('no_meja');

        // Check if the data already exists in the database
        $existingMeja = Meja::where('no_meja', $inputNomorMeja)->first();

        if ($existingMeja) {

            // If data already exists, return an error response or redirect back with an error message
            return redirect()->back()->withInput()->withErrors('Nomor meja sudah ada.');
        }

        // If the data doesn't exist, create a new record and save it to the database
        Meja::create($request->all());

        // Redirect to the index page or any other route after successful creation
        return redirect('meja')->with('success', 'Meja berhasil ditambahkan!');
    }

    public function generate($id)
    {
        $data = Meja::findOrFail($id);
        $encryptedId = encrypt(env("HAFIS_SECRET") . "/-" . $id . "-" . env("HAFIS_SECRET_ID"));
        $qrcode = QrCode::size(300)->generate("http://njenggrik.biz.id/viewmenu/" . "$encryptedId");
        return view('admin.qrcode', compact('qrcode'));
    }

    public function destory($id)
    {
        Meja::where('id', $id)->delete();

        return redirect('meja');
    }
}
