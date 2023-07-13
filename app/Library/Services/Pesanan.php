<?php

namespace App\Library\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Pesanan
{
    static function GetFakturTmp(Request $request)
    {
        $noFaktur = $request->session()->get('fakturs');
        if ($noFaktur == "") {
            $vaFaktur = DB::table("fakturs")->where('kode', 'FakturTmp')->first();
            $noFaktur = $vaFaktur->keterangan + 1;
            $vaFaktur = DB::table("fakturs")->where('kode', 'FakturTmp')->update(["keterangan" => $noFaktur]);
            $noFaktur = "MLG" . str_pad($noFaktur, 10, "0", STR_PAD_LEFT);
            $request->session()->put('fakturs', $noFaktur);
        }
        return $noFaktur;
    }
    static function GetFaktur()
    {
        $vaFaktur = DB::table("fakturs")->where('kode', 'Faktur')->first();
        $noFaktur = $vaFaktur->keterangan + 1;
        $vaFaktur = DB::table("fakturs")->where('kode', 'Faktur')->update(["keterangan" => $noFaktur]);
        $noFaktur = "MLG" . str_pad($noFaktur, 10, "0", STR_PAD_LEFT);

        return $noFaktur;
    }
}
