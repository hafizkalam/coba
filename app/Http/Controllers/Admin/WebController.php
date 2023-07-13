<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Library\Services\Pesanan;
use App\Models\MasterTenant;
use App\Models\Menu;
use App\Models\TransaksiTmp;
use App\Models\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function show()
    {
        $data['data'] = Web::get();
        $data['jsTambahan'] = "$('#web').addClass('active') ;";
        return view('admin.web', $data);
    }

    function coba(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 18000,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' => '10000',
                    'quantity' => 1,
                    'name' => 'Apel'
                ], [
                    'id' => 'b1',
                    'price' => '8000',
                    'quantity' => 1,
                    'name' => 'Jeruk'
                ]
            ),
            'customer_details' => array(
                'first_name' => $request->get('uname'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('number'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('coba', ['snap_token' => $snapToken]);
    }

    public function payment_post(Request $request)
    {
        $json = json_decode($request->get('json'));
        $order = new Order();
        $order->status = $json->transaction_status;
        $order->uname = $request->get('uname');
        $order->email = $request->get('email');
        $order->number = $request->get('number');
        $order->transaction_id = $json->transaction_id;
        $order->order_id = $json->order_id;
        $order->gross_amount = $json->gross_amount;
        $order->payment_type = $json->payment_type;
        $order->payment_code = isset($json->payment_code) ? $json->payment_code : null;
        $order->pdf_url = isset($json->pdf_url) ? $json->pdf_url : null;
        return $order->save() ? redirect(url('/coba'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi kesalahan');
    }

    public function test(Request $request)
    {
        $serverKey = env('MIDTRANS_KEY');
        $hashed = hash('sha512', $request->order_id . $request->status_code, $request->gross_amount . $serverKey);
        $vaFaktur = DB::table("fakturs")->where('kode', 'Faktur')->update(["keterangan" => time()]);
    }
    function createedit(Request $request)
    {
        $vaUpdate = array("description" => $request->input('description'));

        Web::where('name', $request->name)->update($vaUpdate);
        // dd($request->name);
        return redirect('web');
    }

    public function showmenu(Request $request)
    {

        $noFaktur = Pesanan::GetFakturTmp($request);
        $data = $request->all();

        $data['tmp'] = TransaksiTmp::with(['menu'])->where('no_transaksi', $noFaktur)->get();
        $data['data'] = MasterTenant::get();
        $data['faktur'] = $noFaktur;
        $data['nama_menu'] = Menu::with(['tenant'])->get();
        foreach ($data['nama_menu'] as $value) {
            $tenanLama = $value->tenant->name;
            $value->tenant->name = str_replace(' ', '', $value->tenant->name);
            $vaMenu[$value->tenant->name][] = $value;
            $vaMenuLama[$value->tenant->name] = $tenanLama;
        }
        $data['menu_tenant'] = $vaMenu;
        $data['menu_tenant_lama'] = $vaMenuLama;

        $data['tenant'] = MasterTenant::select('name')->groupBy('name')->get();


        $data['url'] = $request->url();

        \Midtrans\Config::$serverKey = env('MIDTRANS_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 18000,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' => '10000',
                    'quantity' => 1,
                    'name' => 'Apel'
                ], [
                    'id' => 'b1',
                    'price' => '8000',
                    'quantity' => 1,
                    'name' => 'Jeruk'
                ]
            ),
            'customer_details' => array(
                'first_name' => $request->get('uname'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('number'),
            ),
        );

        $data['snap_token'] = \Midtrans\Snap::getSnapToken($params);

        return view('layoutnew.menu', $data);
    }
}
