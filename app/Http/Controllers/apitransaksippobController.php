<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\transaksippob;
use App\Models\customer;
use App\Models\detailppob;
use \Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class apitransaksippobController extends Controller
{
    public function index($id){
        
        $tpp = transaksippob::with('customer')->where('customer_ppob',$id)->get();
        // $tpp = transaksippob::all();
        // return view('ppob.ppob')->with('ppob',$ppob);
        return response()->json([
            'status' => 'success',
            'message' => 'data ppob',
            'data' => $tpp,
        ]);
    
  
}
    public function add(Request $request , $id){
        $validate = Validator::make($request->all(), [
            // 'customer_ppob' => 'required',
            'produk_transaksi_ppob' => 'required',
            // 'harga_transaksi_ppob' => 'required',
            // 'bayar_transaksi_ppob' => 'required',
            // 'tanggal_transaksi_ppob' => 'required',
            'nomor_inputan' => 'required',
            'pin_customer' => 'required',
            // 'total_js' => 'required',
        
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'msg' => "cek your data wik",
                'data' => $validate->errors()
            ], 400);
        }
        $customer = customer::find($id);
        if ($customer == null) {
            return response()->json([
                'status' => 'failed',
                'msg' => "data customer not found",
                'data' => null,
            ]);
        }
        if (!Hash::check($request->pin_customer, $customer->pin_customer, [])) {
            return response()->json([
                'status' => false,
                'msg' => 'password wrong',
                'data' => null,
            ]);
        }
        
       
        $detailppob = detailppob::find($request->produk_transaksi_ppob);
        if ($detailppob == null) {
            return response()->json([
                'status' => 'failed',
                'msg' => "data ppob not found",
                'data' => null,
            ]);
        }
        $tpp = new transaksippob;
        $tpp->customer_ppob = $id; 
        $tpp->produk_transaksi_ppob = $detailppob->id_detailppob; 
        $tpp->harga_transaksi_ppob = $detailppob->harga_detailppob;
        $tpp->bayar_transaksi_ppob = $detailppob->bayar_detailppob;
        $bayar = $tpp->bayar_transaksi_ppob ;
        $tpp->tanggal_transaksi_ppob = Carbon::now()->format('Y-m-d');
        $tpp->nomor_inputan = $request->nomor_inputan;
        $tpp->status_ppob = 'belum diproses';
        $tpp->created_at = Carbon::now();
       

        $tpp->save();

        // $customerppob = customer::find($id);
        // if ($customerppob->saldo_customer < $bayar) {
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Saldo Tidak Mencukupi',
        //         'data' => null,
               
        //     ]);
        //    }
        
        // $saldoawal = $customerppob->saldo_customer;
        // $saldoppob = $tpp->bayar_transaksi_ppob;
        // $saldoakhir = $saldoawal - $saldoppob;
        // $customerppob->saldo_customer = $saldoakhir;
        // $customerppob->save();
    // return view('ppob.ppob')->with('ppob',$ppob);
    return response()->json([
        'status' => 'success',
        'message' => 'data ppob',
        'data' => $tpp,
        // 'data customer' =>$customer,
    ]);


}
}
