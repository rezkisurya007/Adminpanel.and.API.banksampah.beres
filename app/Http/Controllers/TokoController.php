<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\customer;
use App\Models\topup;
use App\Models\transaksi;
use App\Models\kecamatan;
use App\Models\User;
use Carbon\Carbon;

class TokoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if (auth()->user()->role=="superadmin") {
            $toko = customer::with('kecamatan')->where('role_customer','toko')->get();
            $kecamatan = kecamatan::where('status_kecamatan',0)->get();
        return view('toko.toko')->with('toko',$toko)->with('kecamatan',$kecamatan);
        }
        if (auth()->user()->role=="admin") {
            $user = User::find(auth()->user()->id);
            $toko = customer::with('kecamatan')->where('id_kecamatan_customer',$user->id_kecamatan_user)->where('role_customer','toko')->get();
        $kecamatan = kecamatan::where('id_kecamatan',$user->id_kecamatan_user);
        return view('toko.toko')->with('toko',$toko)->with('kecamatan',$kecamatan);
        }
        
        // with('customer')->where('id_customer_transaksi',$customer->customer_id)->get();
        
        
    }
    public function addtoko(Request $request)
    {

        if(customer::find($request->input('id_customer'))){
            return redirect('/toko')->with('warning', 'Id Toko sudah tersedia');
        }
   
        $toko = new customer;
        $toko->id_customer = $request->input('id_customer'); 
        $toko->id_kecamatan_customer = $request->input('id_kecamatan_customer'); 
        $toko->nama_customer = $request->input('nama_customer');
        $toko->alamat_customer = $request->input('alamat_customer');
        $toko->saldo_customer = $request->input('saldo_customer');
        $toko->pin_customer = Hash::make($request->pin_customer);
        $toko->no_hp_customer = $request->input('no_hp_customer');
        $toko->role_customer = 'toko';
        $toko->save();
        
        return redirect("/toko")->with('success', 'Berhasil Menambahkan Toko');
    }
    public function updatetoko(Request $request,$id)
    {
   
        $toko = customer::find($id);
        // $toko->id_customer = $request->input('id_customer'); 
        $toko->id_kecamatan_customer = $request->input('id_kecamatan_customer'); 
        $toko->nama_customer = $request->input('nama_customer');
        $toko->alamat_customer = $request->input('alamat_customer');
        // $toko->saldo_customer = $request->input('saldo_customer');
        $toko->pin_customer = Hash::make($request->pin_customer);
        $toko->no_hp_customer = $request->input('no_hp_customer');
        $toko->role_customer = 'toko';
        $toko->save();
        
        return redirect("/toko")->with('success', 'Berhasil Update toko');
    }
    public function deletetoko($id)
    {
     customer::find($id)->delete();
        
        return redirect("/toko")->with('success', 'Berhasil Update toko');
    }
    public function topuptoko(Request $request,$id)
    {
   
        $toko = customer::find($id);
        
        $saldoawal = $toko->saldo_customer;
        $saldotopup = $request->input('saldo_customer');
        $saldoakhir = $saldoawal + $saldotopup;
        $toko->saldo_customer = $saldoakhir;
        $toko->save();

        $topup = new topup;
        $topup->nama_customer_topup = $toko->nama_customer ; 
        $topup->id_kecamatan_topup = $toko->id_kecamatan_customer ; 
        $topup->tanggal_topup = Carbon::now();
        $topup->nominal_topup = $saldotopup;
        $topup->total_saldo_topup = $toko->saldo_customer ; 
        $topup->save();
        
        return redirect("/toko")->with('success', 'Berhasil menambahkan saldo');
    }
}
