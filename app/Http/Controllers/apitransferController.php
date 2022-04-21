<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\transfer;
use App\Models\customer;
use Carbon\Carbon;
use \Validator;
class apitransferController extends Controller
{
    public function index($id){
        
        $transfer = transfer::with('customer')->where('pengirim',$id)->get();
        // return view('ppob.ppob')->with('ppob',$ppob);
        return response()->json([
            'status' => 'success',
            'message' => 'data transfer',
            'data' => $transfer,
        ]);  
}

public function add(Request $request, $id){
    $validate = Validator::make($request->all(), [
        // 'id_kecamatan_transfer' => 'required',
        // 'pengirim' => 'required',
        'penerima' => 'required',
        // 'tanggal' => 'required',
        // 'tanggal_transaksi_ppob' => 'required',
        'nominal' => 'required',
        // 'total_js' => 'required',
    
    ]);
    if ($validate->fails()) {
        return response()->json([
            'status' => 'success',
            'msg' => "Get data successfully",
            'data' => $validate->errors()
        ], 400);
    }
    $transfer = new transfer;
    $customerpengirim = customer::find($id);
    if ($customerpengirim->saldo_customer < $request->nominal) {
     return response()->json([
         'status' => 'success',
         'message' => 'Saldo Tidak Mencukupi',
         'data' => null,
        
     ]);
    }
    if ($customerpengirim == null) {
        return response()->json([
            'status' => 'failed',
            'msg' => "data customer not found",
            'data' => null,
        ]);
    } 
    $customerpenerima = customer::find($request->penerima);
    if ($customerpenerima == null) {
        return response()->json([
            'status' => 'failed',
            'msg' => "data penerima not found",
            'data' => null,
        ]);
    } 
    if ($customerpenerima == $customerpengirim) {
        return response()->json([
            'status' => 'failed',
            'msg' => "data penerima tidak valid",
            'data' => null,
        ]);
    }
 
    $transfer->id_kecamatan_transfer = $customerpengirim->id_kecamatan_customer; 
    $transfer->pengirim = $id; 
    $transfer->penerima = $request->penerima;
    $transfer->tanggal = Carbon::now()->format('Y-m-d');
    $transfer->nominal = $request->nominal;
    $nominal = $transfer->nominal;
    $transfer->created_at = Carbon::now();
    
   

    $transfer->save();

   
        $saldopengirim = $customerpengirim->saldo_customer; 
        $saldotransfer = $nominal;
        $saldoakhir = $saldopengirim - $saldotransfer;
        $customerpengirim->saldo_customer = $saldoakhir;
        $customerpengirim->save();

  
        $saldopenerima = $customerpenerima->saldo_customer; 
        $saldotransferpenerima = $nominal;
        $saldoakhirpenerima = $saldopenerima + $saldotransferpenerima;
        $customerpenerima->saldo_customer = $saldoakhirpenerima;
        $customerpenerima->save();


        

// return view('ppob.ppob')->with('ppob',$ppob);
return response()->json([
    'status' => 'success',
    'message' => 'data transfer',
    'data transfer' => $transfer,
    'data pengirim' => $customerpengirim,
    'data penerima' => $customerpenerima,
]);
}
}
