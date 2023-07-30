<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function cetak(Request $request)
    {
        $menu = Menu::get()->toArray();
        foreach ($menu as $value) {
            $data['menu'][$value['id']] = $value;
        }
<<<<<<< HEAD
        $dataTenant = MasterTenant::get()->toArray();
        foreach ($dataTenant as $value) {
            $nama_tenant[$value['id']] = $value['name'];
        }

        $data['nama_tenant'] = $nama_tenant;
        $data['data'] = $request->session()->get('data');
        $data['filter'] = $request->session()->get('filter');

        $idTenant = Auth::user()->id;

        $tenant = MasterTenant::where("user_id", $idTenant)->first();
        $data['tenant'] = $tenant;

        $pdf = Pdf::loadView('admin.print', $data)->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download(rand() . 'transaksi.pdf');
=======
        $data['data'] = $request->session()->get('data');

        $pdf = Pdf::loadView('admin.print', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
        // return $pdf->download('transaksi.pdf');
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
    }
    public function show(Request $request)
    {

        $user = Auth::user();

        // Check if the user is authenticated and has unread notifications
        if ($user && $user->unreadNotifications) {
            // Access the unread notifications
            $unreadNotifications = $user->unreadNotifications;

            // Perform actions with the unread notifications
            foreach ($unreadNotifications as $notification) {
                $notification->markAsRead();
            }
        }
        $idTenant = Auth::user()->id;
        $tenant = MasterTenant::where("user_id", $idTenant)->first();
        $dataTenant = MasterTenant::get()->toArray();
<<<<<<< HEAD
        foreach ($dataTenant as $value) {
=======
        foreach ($dataTenant as $value){
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
            $nama_tenant[$value['id']] = $value['name'];
        }

        $data['nama_tenant'] = $nama_tenant;

<<<<<<< HEAD
        $data['data'] = Transaksi::with(['detail.menu'])
        // ->where("status_pembayaran","!=","2")
        ->whereHas('detail.menu', function ($query) use ($tenant) {
            if (Auth::user()->level == 2) {
                $query->where("master_tenants_id", $tenant->id);
            }
        });

=======
        $data['data'] = Transaksi::with(['detail.menu'])->whereHas('detail.menu', function ($query) use ($tenant) {
            if (Auth::user()->level != 1) {

                $query->where("master_tenants_id", $tenant->id);
            }
        });
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
        $data['tenant'] = $tenant;
        $filter = $request->all();
        if (count($filter) > 0) {
            $data['data'] = $data['data']->whereBetween("tgl_transaksi", [$filter['awal'], $filter['akhir']]);
            if ($filter['status_pembayaran'] != "") {
<<<<<<< HEAD

                $data['data'] = $data['data']->where("status_pembayaran", $filter['status_pembayaran']);
            }

            if ($filter['cara_pembayaran'] != "") {
                $data['data'] = $data['data']->where("cara_pembayaran", $filter['cara_pembayaran']);
            }
            if (Auth::user()->level == '1' || Auth::user()->level == '3') {
                if ($filter['filter-tenant'] != "") {

                    $idFilterTenant = $filter['filter-tenant'];

                    $data['data'] = $data['data']->whereHas('detail.menu', function ($query) use ($idFilterTenant) {
                        $query->where("master_tenants_id", $idFilterTenant);
                    });
                    $data['id_filter_tenant'] = $idFilterTenant;
                }
            }
        }
        $data['data'] = $data['data']->get()->toArray();
        // $data['data'] = $data['data']->orderBy("no_transaksi","desc")->get()->toArray();
=======
                $data['data'] = $data['data']->where("status_pembayaran", $filter['status_pembayaran']);
            }
            if ($filter ['filter-tenant'] != "") {
                $idFilterTenant = $filter ['filter-tenant'];
                $data['data'] = $data['data']->whereHas('detail.menu', function ($query) use ($idFilterTenant) {

                        $query->where("master_tenants_id", $idFilterTenant);
                });
            }
        }
        $data['data'] = $data['data']->get()->toArray();
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6

        $menu = Menu::get()->toArray();
        foreach ($menu as $value) {
            $data['menu'][$value['id']] = $value;
        }
        $data['jsTambahan'] = "$('#transaksi').addClass('active') ;";
        $request->session()->put('data', $data['data']);
<<<<<<< HEAD
        $request->session()->put('filter', $filter);

=======
>>>>>>> fbb8abbb9401c66f114e4b4fda004e8580828cc6
        return view('admin.transaksi', $data);
    }

    function otorisasi(Request $request)
    {
        $data = $request->all();
        Transaksi::where("no_transaksi", $data['faktur'])->update(["status_pembayaran" => $data['acc']]);
        echo json_encode("oke");
    }
}
