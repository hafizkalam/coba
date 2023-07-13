<?php

namespace App\Http\Controllers;

use App\Library\Services\Pesanan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiTmp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TransaksiTmpController extends Controller
{
    function tambahpesanan(Request $request)
    {
        $data = $request->all();
        TransaksiTmp::updateOrCreate(['no_transaksi' => $data['no_transaksi'], 'id_menu' => $data['id_menu']], $data);
        echo json_encode("oke");
    }

    function deletepesanan(Request $request)
    {
        $data = $request->all();
        TransaksiTmp::where(['no_transaksi' => $data['no_transaksi'], 'id_menu' => $data['id_menu']])->delete();
        echo json_encode("oke");
    }

    function order(Request $request)
    {
        $data['noFaktur'] = $request->session()->get('fakturs');
        $noMeja = "XXX";
        $faktur = Pesanan::GetFaktur();
        $tmp = TransaksiTmp::with(['menu'])->where('no_transaksi', $data['noFaktur'])->get()->toArray();
        $total = 0;
        foreach ($tmp as $value) {
            $value['no_meja'] = "xxx";
            $value['no_transaksi'] = $faktur;
            $total += $value['qty'] * $value['menu']['harga'];
            $value['total'] = $value['qty'] * $value['menu']['harga'];
            TransaksiDetail::create($value);
        }
        $vaTransaksi = array(
            "no_transaksi" => $faktur,
            "no_meja" => "xxx",
            "tgl_transaksi" => date("Y-m-d"),
            "cara_pembayaran" => "Cash",
            "status_pembayaran" => "Menunggu Otorisasi",
            "total" => $total
        );
        Transaksi::create($vaTransaksi);
        TransaksiTmp::with(['menu'])->where('no_transaksi', $data['noFaktur'])->delete();
        $data['tmp'] = TransaksiDetail::where('no_transaksi', $faktur)->get();
        return view('layoutnew.order', $data);
    }
    function jumlah(Request $request)
    {
        $noFaktur = $request->session()->get('fakturs');
        $data = TransaksiTmp::where('no_transaksi', $noFaktur)->where('qty', '!=', '0')->get()->toArray();
        if (count($data) > 0) {

            echo count($data);
        }
    }

    function notespesanan(Request $request)
    {
        $data = $request->all();
        TransaksiTmp::where(['id' => $data['id']])->update(['notes' => $data['notes']]);
    }
    function list(Request $request)
    {
        $noFaktur = $request->session()->get('fakturs');
        $data['tmp'] = TransaksiTmp::with(['menu'])->where('no_transaksi', $noFaktur)->get();

        return view('layoutnew.list_keranjang', $data);
    }
}
