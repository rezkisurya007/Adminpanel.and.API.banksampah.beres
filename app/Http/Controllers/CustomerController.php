<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\customer;
use App\Models\transaksi;
use App\Models\kecamatan;
use App\Models\User;
use App\Models\topup;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if (auth()->user()->role=="superadmin" ) {
            $customer = customer::with('kecamatan')->where('role_customer','customer')->where('customer_is_delete',0)->get();
            $kecamatan = kecamatan::where('status_kecamatan',0)->get();
            return view('customer.customer')->with('customer',$customer)->with('kecamatan',$kecamatan);
        }
        if (auth()->user()->role=="admin") {
            $user = User::find(auth()->user()->id);
            $customer = customer::with('kecamatan')->where('id_kecamatan_customer',$user->id_kecamatan_user)->where('role_customer','customer')->where('customer_is_delete',0)->get();
            $kecamatan = kecamatan::where('id_kecamatan',$user->id_kecamatan_user)->get();            
            return view('customer.customer')->with('customer',$customer)->with('kecamatan',$kecamatan);
        }
       
       
        // with('customer')->where('id_customer_transaksi',$customer->customer_id)->get();
        
        
    }
    public function addcustomer(Request $request)
    {
        $cus = DB::table('customer')->where('customer_is_delete','=',1)->first();
        if ($cus) {
            $cus = customer::find($cus->id_customer);
            $cus->nama_customer = $request->input('nama_customer');
            $cus->alamat_customer = $request->input('alamat_customer');
            $cus->saldo_customer = $request->input('saldo_customer');
            $cus->pin_customer = Hash::make($request->pin_customer);
            $cus->no_hp_customer = $request->input('no_hp_customer');
            $cus->role_customer = 'customer';
            $cus->customer_is_delete = 0;
            $cus->save();

            return redirect("/customer")->with('success', 'Berhasil Menambahkan Customer');

        }

        


        $customer = new customer;
        if ($customer->customer_is_delete == 0) {
            if(customer::find($request->input('id_customer'))){
                return redirect('/customer')->with('warning', 'Id anggota sudah tersedia');
            }
        }
        $customer->id_customer = $request->input('id_customer'); 
        $customer->id_kecamatan_customer = $request->input('id_kecamatan_customer'); 
        $customer->nama_customer = $request->input('nama_customer');
        $customer->alamat_customer = $request->input('alamat_customer');
        $customer->saldo_customer = $request->input('saldo_customer');
        $customer->pin_customer = Hash::make($request->pin_customer);
        $customer->no_hp_customer = $request->input('no_hp_customer');
        $customer->role_customer = 'customer';
        $customer->save();

        

        
        return redirect("/customer")->with('success', 'Berhasil Menambahkan Customer');
    }
    public function updatecustomer(Request $request,$id)
    {
   
        $customer = customer::find($id);
        // $customer->id_customer = $request->input('id_customer'); 
        $customer->id_kecamatan_customer = $request->input('id_kecamatan_customer'); 
        $customer->nama_customer = $request->input('nama_customer');
        $customer->alamat_customer = $request->input('alamat_customer');
        // $customer->saldo_customer = $request->input('saldo_customer');
        $customer->pin_customer = Hash::make($request->pin_customer);
        $customer->no_hp_customer = $request->input('no_hp_customer');
        $customer->role_customer = 'customer';
        $customer->save();
        
        return redirect("/customer")->with('success', 'Berhasil Update customer');
    }
    public function deletecustomer($id)
    {
     $customer = customer::find($id);
     $customer->customer_is_delete = 1;
     $customer->save();
        
        return redirect("/customer")->with('success', 'Berhasil Update customer');
    }
    public function topupcustomer(Request $request,$id)
    {
   
        $customer = customer::find($id);
        
        $saldoawal = $customer->saldo_customer;
        $saldotopup = $request->input('saldo_customer');
        $saldoakhir = $saldoawal + $saldotopup;
        $customer->saldo_customer = $saldoakhir;
        $customer->save();

        $topup = new topup;
        $topup->nama_customer_topup = $customer->nama_customer ; 
        $topup->id_kecamatan_topup = $customer->id_kecamatan_customer ; 
        $topup->tanggal_topup = Carbon::now()->format('Y-m-d');
        $topup->nominal_topup = $saldotopup;
        $topup->total_saldo_topup = $customer->saldo_customer ; 
        $topup->created_at = Carbon::now();
        $topup->save();
        
        return redirect("/customer")->with('success', 'Berhasil menambahkan saldo');
    }
}
