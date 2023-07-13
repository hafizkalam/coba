<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function show()
    {

        $data['data'] = Transaksi::with(['detail'])->get()->toArray();
        $menu = Menu::get()->toArray();
        foreach ($menu as $value) {
            $data['menu'][$value['id']] = $value;
        }
        $data['jsTambahan'] = "$('#transaksi').addClass('active') ;";

        return view('admin.transaksi', $data);
    }
}
