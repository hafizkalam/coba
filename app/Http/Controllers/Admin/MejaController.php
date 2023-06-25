<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MejaController extends Controller
{
    public function show()
    {
        $data['user'] = Auth::user();
        $data['data'] = Meja::get();
        return view('admin.meja', $data);
    }

    public function create(Request $request)
    {

        $meja = new Meja;
        $meja->no_meja = $request->no_meja;
        $meja->save();
        return view('admin.meja', $meja);

    }

    public function generate($id)
    {
        $data = Meja::findOrFail($id);
        $qrcode = QrCode::size(300)->generate("http://127.0.0.1:8000/"."$data->no_meja");
        return view('admin.qrcode', compact('qrcode'));
    }

    public function destory($id)
    {
        Meja::where('id', $id)->delete();

        return redirect('meja');
    }
}
