<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function show(){
        $data['data'] = Transaksi::get();

        return view('admin.transaksi', $data);
    }
}
