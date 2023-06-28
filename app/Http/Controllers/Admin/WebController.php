<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTenant;
use App\Models\Web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class WebController extends Controller
{
    public function show()
    {
        $data['data'] = Web::get();
        return view('admin.web', $data);
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
        $session = new Session();
        // $session->set('variableName', 1);

        $noFaktur = $session->get('fakturs');
        if($noFaktur == "")
        {
            $vaFaktur = DB::table("fakturs")->where('kode','Faktur')->first();
            $noFaktur = $vaFaktur->keterangan + 1;
            $vaFaktur = DB::table("fakturs")->where('kode','Faktur')->update(["keterangan"=>$noFaktur]);
            $session->set('fakturs', $noFaktur);
        }
        // dd(str_pad($noFaktur,10,"0",STR_PAD_LEFT));

        // dd($request->session()->get('nofaktur'));
        $data = $request->all();
        $no = "1";
        $data['data'] = MasterTenant::get();
        $data['nama_menu'] = MasterTenant::get();
        foreach($data['nama_menu'] as $value){
            $tenanLama = $value->name_tenant;
            $value->name_tenant = str_replace(' ', '', $value->name_tenant);
            $vaMenu[$value->name_tenant][] = $value;
            $vaMenuLama[$value->name_tenant] = $tenanLama;

        }
        // echo "<pre>";
        // print_r($vaMenu);
        // print_r($vaMenuLama);
        // exit;
        // dd($vaMenuLama);
        $data['menu_tenant'] = $vaMenu;
        $data['menu_tenant_lama'] = $vaMenuLama;

        $data['tenant'] = MasterTenant::select('name_tenant')->groupBy('name_tenant')->get();
        // $data['tenant'] = MasterTenant::select('nama_menu')->where('name_tenant', '')->get();

        $data['url'] = $request->url();
        return view('layout.viewmenu', $data);
    }
}
