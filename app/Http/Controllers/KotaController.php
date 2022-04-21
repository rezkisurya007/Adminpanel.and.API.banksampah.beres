<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kota;
use App\Models\kecamatan;

class KotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $kota = kota::where('kota_is_delete',0)->get();
        return view('kota.kota')->with('kota',$kota);
    }
    public function addkota(Request $request)
    {
   
        $kota = new kota;
        $kota->nama_kota = $request->input('nama_kota');
        $kota->save();
        
        return redirect('/kota')->with('success', 'Berhasil Menambahkan kota');
    }
    public function updatekota(Request $request, $id)
    {
   
        $kota = kota::find($id);
        $kota->nama_kota = $request->input('nama_kota');
        $kota->save();
        
        return redirect('/kota')->with('success', 'Berhasil update kota');
    }
    public function deletekota($id)
    {
   
        $kota = kota::find($id);
        $kota->kota_is_delete = 1;
        $kota->save();
        $ke = $kota->kecamatan->id_kota_kecamatan;

        // $kecamatan = kecamatan::find($ke);
        $kecamatan = kecamatan::where('id_kota_kecamatan',$ke)->first();
        
        $kecamatan->status_kecamatan = 1;
        $kecamatan->save();
        

        
        return redirect('/kota')->with('success', 'Berhasil Delete Kota');
    }
}
